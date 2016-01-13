<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{

    /**
     * Displays a view
     *
     * @return void|\Cake\Network\Response
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function display()
    {
        $path = func_get_args();

        $count = count($path);
        if (!$count) {
            return $this->redirect('/');
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        $this->set(compact('page', 'subpage'));
        
        if ($page == 'contact') {
            $this->contact();
        }
        
        if ($page == 'home') {
            $this->displayHome();
        }

        try {
            $this->render(implode('/', $path));
        } catch (MissingTemplateException $e) {
            if (Configure::read('debug')) {
                throw $e;
            }
            throw new NotFoundException();
        }
    }
    
     private function displayHome()
    {
        $this->loadModel('bookmarks');
       
        $bookmarks = $this->bookmarks->find("all");


          $this->set('bookmarks',$bookmarks);
          // $this->set(compact('$bookmarks'));
         
    
    }
    private function contact()
    {   
        $sent = false;
        
        $success = 'Thank you. You are very important to us, ';
        $success .= 'all information received will always remain confidential. ';
        $success .= 'We will contact you as soon as we review your message.';
        $error = 'The message could not be sended. Please, try again.';

        if ($this->request->is('post')) {
            if (!empty($_POST["email"]) && !empty($_POST['content'])){
                $email = new Email('default');
                $email->to('admin@trident.io')
                    ->subject(__('Feedback Form'))
                    ->send($_POST['content']);

                $this->Flash->success($success);
                $sent = true;
            } else { 
                $this->Flash->error($error);
            }         
        }
        $this->set('sent', $sent);
    }  
}
