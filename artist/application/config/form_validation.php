<?php
$config = array(
            'login' => array(
                  array('field' => 'username',
                        'label' => 'Username',
                        'rules' => 'required|min_length[2]|max_length[12]|xss_clean'
                        ),
                  array('field' => 'password',
                        'label' => 'Password',
                        'rules' => 'required|md5'
                        )
            ),
            'upload' => array(
                  array('field' => 'title',
                        'label' => 'title',
                        'rules' => 'xss_clean'
                        ),
                  array('field' => 'lrgimg',
                        'label' => 'lrgimg',
                        'rules' => 'required'
                        ),
                  array('field' => 'smallimg',
                        'label' => 'smallimg',
                        'rules' => 'required'
                        )
                  )
      );

?>