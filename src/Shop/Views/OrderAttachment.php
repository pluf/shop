<?php

class Shop_Views_OrderAttachment extends Pluf_Views
{

    /**
     *
     * @param Pluf_HTTP_Request $request            
     * @param array $match            
     * @return Shop_OrderAttachment
     */
    public function create($request, $match)
    {
        $attachment = $this->createManyToOne($request, $match, array(
            'model' => 'Shop_OrderAttachment',
            'parent' => 'Shop_Order',
            'parentKey' => 'order_id'
        ));
        $attachment->file_path = Pluf::f('upload_path') . '/' . $request->tenant->id .
        '/shop-order-attachment';
        if (! is_dir($attachment->file_path)) {
            if (false == @mkdir($attachment->file_path, 0777, true)) {
                throw new Pluf_Form_Invalid(
                    'An error occured when creating the upload path. Please try to send the file again.');
            }
        }
        
        $extra = array(
            'model' => $attachment
        );
        $form = new Shop_Form_OrderAttachmentUpdate(array_merge($request->REQUEST, $request->FILES), $extra);
        return $form->save();
    }
    
    /**
     *
     * @param Pluf_HTTP_Request $request            
     * @param array $match            
     * @return Shop_OrderAttachment
     */
    public static function upload($request, $match)
    {
        // تعیین داده‌ها
        $attachment = Pluf_Shortcuts_GetObjectOr404('Shop_OrderAttachment', $match['modelId']);
        // اجرای درخواست
        $extra = array(
            'model' => $attachment
        );
        $form = new Shop_Form_AttachmentUpdate(array_merge($request->REQUEST, $request->FILES), $extra);
        return $form->save();
    }

    /**
     *
     * @param Pluf_HTTP_Request $request            
     * @param array $match            
     * @return Shop_OrderHistory
     */
    public static function download($request, $match)
    {
        // GET data
        if (!array_key_exists('modelId', $match)) {
            throw new Pluf_Exception_BadRequest('attachment id required');
        } 
        Pluf::loadFunction('Pluf_Shortcuts_GetObjectOr404');
        $attachment = Pluf_Shortcuts_GetObjectOr404('Shop_OrderAttachment', $match['modelId']);
        // XXX: maso, 2019: check order too
        // Do
        $response = new Pluf_HTTP_Response_File($attachment->getAbsloutPath(), $attachment->mime_type);
        $response->headers['Content-Disposition'] = sprintf('attachment; filename="%s"', $attachment->file_name);
        return $response;
    }

}

