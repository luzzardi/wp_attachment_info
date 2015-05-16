<?php

class AttachmentInfo_Admin_Controller
{

     static public function index()
    {
        $args = array(
            'post_type' => 'attachment',
            'numberposts' => -1,
            'post_status' => null,
            'post_parent' => null,
            'post_mime_type' => array(
              'image/gif',
              'image/jpeg',
              'image/pjpeg',
              'image/png',
              'image/bmp',
              'image/svg',
              'image/tiff'
            )
        );
        $attachments = get_posts($args);
        return AttachmentInfo::viewAdmin('index', compact('attachments'));
    }

    static public function getAttachmentInfo() {
        if (empty($_POST['id'])) {
            return;
        }
        $atttachment = wp_get_attachment_metadata($_POST['id']);
        echo '<div class="image-preview">'.wp_get_attachment_image($_POST['id']).'</div>';
        echo "<pre>";
        print_r($atttachment);
        echo "</pre>";
        return;
    }

}
