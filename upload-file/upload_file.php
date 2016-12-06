<?php

//Upload file using Ajax 

add_action( 'wp_enqueue_scripts', 'fun_enqueue_script' );
function fun_enqueue_script()
{

    $ajax_path = admin_url('admin-ajax.php');
        wp_enqueue_script('file_upload', plugins_url('js/file_upload.js', __FILE__), array('jquery'));
        wp_localize_script(
            'file_upload',
            'vars',
            array(
                'ajax_path' =>$ajax_path,
                
               )
        );
}

//ajax call to upload file 
add_action('wp_ajax_upload_file', 'upload_file');
add_action('wp_ajax_nopriv_upload_file', 'upload_file');
function upload_file()
{
    global $wpdb;

  
    $data = array();
    if (isset($_FILES)) {
        if (! function_exists('wp_handle_upload')) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
        }
       
        $uploadedfile = $_FILES['file'];  //file is passed from jQuery ajax
        
              
        $filename = $_FILES['file']['name'];
                
        $upload_overrides = array( 'test_form' => false );

        add_filter('upload_dir', 'change_uploads_directory_path'); //Add filter to change default upload path
          
        $ssafile = wp_handle_upload($uploadedfile, $upload_overrides);

        remove_filter('upload_dir', 'change_uploads_directory_path');//Remove filter to change default upload path
       
        if ($ssafile && ! isset($ssafile['error'])) {
            $data =  array('files' => $ssafile);

        } else {
            $data =  array('error' => $ssafile['error']) ;
        }
    } else {
        $data = array('error' => __('No file submitted','wordfile'));
    }

    echo json_encode($data);
    die();
}
function change_uploads_directory_path($path)
{

    $path = apply_filters('ssa_change_file_upload_path', $path);
    return $path;
}
