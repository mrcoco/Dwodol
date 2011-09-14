<?
function isImage($handler) {
    /* Make the string all lowercase */
    $handler = strtolower($handler);
    /* Get the extension */
    $extension =  end(explode('.', $handler));
    
    /* Check if filetype is allowed */
    if ($extension == 'jpg' || $extension == 'png' || $extension == 'gif' || $extension == 'bmp') {
        /* Check if the file exists */
        if (file_exists($handler)) {
            return true;
        } else {
			return false;
        }
    } else {
		return false;
    }
}?>