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
        $order = null;
        if (isset($match['secureId'])) {
            $order = Shop_Shortcuts_GetObjectBySecureIdOr404('Shop_Order', $match['secureId']);
            $match['parentId'] = $order->id;
        } else {
            $order = Pluf_Shortcuts_GetObjectOr404('Shop_Order', $match['parentId']);
            if (!$this->canModifyOrder($request, $order)) {
                return new Pluf_Exception_Unauthorized('You are not allowed to do this action.');
            }
        }
        $attachment = $this->createManyToOne($request, $match, array(
            'model' => 'Shop_OrderAttachment',
            'parent' => 'Shop_Order',
            'parentKey' => 'order_id'
        ));
        $attachment->file_path = Pluf::f('upload_path') . '/' . $request->tenant->id . '/shop-order-attachment';
        if (! is_dir($attachment->file_path)) {
            if (false == @mkdir($attachment->file_path, 0777, true)) {
                throw new Pluf_Form_Invalid('An error occured when creating the upload path. Please try to send the file again.');
            }
        }

        $extra = array(
            'model' => $attachment
        );
        $form = new Shop_Form_OrderAttachmentUpdate(array_merge($request->REQUEST, $request->FILES), $extra);
        return $form->save();
    }

    public function find($request, $match)
    {
        $order = null;
        if (isset($match['secureId'])) {
            $order = Shop_Shortcuts_GetObjectBySecureIdOr404('Shop_Order', $match['secureId']);
            $match['parentId'] = $order->id;
        } else {
            $order = Pluf_Shortcuts_GetObjectOr404('Shop_Order', $match['parentId']);
            if (! $this->canViewOrder($request, $order)) {
                return new Pluf_Exception_Unauthorized('You are not allowed to do this action.');
            }
        }
        $pag = $this->findManyToOne($request, $match, array(
            'parent' => 'Shop_Order',
            'parentKey' => 'order_id',
            'model' => 'Shop_OrderAttachment'
        ));
        return $pag;
    }

    public function get($request, $match)
    {
        $order = null;
        if (isset($match['secureId'])) {
            $order = Shop_Shortcuts_GetObjectBySecureIdOr404('Shop_Order', $match['secureId']);
            $match['parentId'] = $order->id;
        } else {
            $order = Pluf_Shortcuts_GetObjectOr404('Shop_Order', $match['parentId']);
            if (! $this->canViewOrder($request, $order)) {
                return new Pluf_Exception_Unauthorized('You are not allowed to do this action.');
            }
        }
        $res = $this->getManyToOne($request, $match, array(
            'model' => 'Shop_OrderAttachment',
            'parent' => 'Shop_Order',
            'parentKey' => 'order_id'
        ));
        return $res;
    }
    
    public function update($request, $match)
    {
        $order = null;
        if (isset($match['secureId'])) {
            $order = Shop_Shortcuts_GetObjectBySecureIdOr404('Shop_Order', $match['secureId']);
            $match['parentId'] = $order->id;
        } else {
            $order = Pluf_Shortcuts_GetObjectOr404('Shop_Order', $match['parentId']);
            if (! $this->canModifyOrder($request, $order)) {
                return new Pluf_Exception_Unauthorized('You are not allowed to do this action.');
            }
        }
        $res = $this->updateManyToOne($request, $match, array(
            'model' => 'Shop_OrderAttachment',
            'parent' => 'Shop_Order',
            'parentKey' => 'order_id'
        ));
        return $res;
    }

    public function delete($request, $match)
    {
        $order = null;
        if (isset($match['secureId'])) {
            $order = Shop_Shortcuts_GetObjectBySecureIdOr404('Shop_Order', $match['secureId']);
            $match['parentId'] = $order->id;
        } else {
            $order = Pluf_Shortcuts_GetObjectOr404('Shop_Order', $match['parentId']);
            if (! $this->canModifyOrder($request, $order)) {
                return new Pluf_Exception_Unauthorized('You are not allowed to do this action.');
            }
        }
        $res = $this->deleteManyToOne($request, $match, array(
            'model' => 'Shop_OrderAttachment',
            'parent' => 'Shop_Order',
            'parentKey' => 'order_id'
        ));
        return $res;
    }
    
    /**
     *
     * @param Pluf_HTTP_Request $request
     * @param array $match
     * @return Pluf_HTTP_Response_File
     */
    public function download($request, $match)
    {
        // Check order
        $order = null;
        if (isset($match['secureId'])) {
            $order = Shop_Shortcuts_GetObjectBySecureIdOr404('Shop_Order', $match['secureId']);
        } else {
            $order = Pluf_Shortcuts_GetObjectOr404('Shop_Order', $match['orderId']);
            // Check access to order
            if (! $this->canViewOrder($request, $order)) {
                return new Pluf_Exception_Unauthorized('You are not allowed to do this action.');
            }
        }
        // Check attachment
        if (! array_key_exists('modelId', $match)) {
            throw new Pluf_Exception_BadRequest('attachment id required');
        }
        Pluf::loadFunction('Pluf_Shortcuts_GetObjectOr404');
        $attachment = Pluf_Shortcuts_GetObjectOr404('Shop_OrderAttachment', $match['modelId']);
        if ($order->id != $attachment->get_order()->id) {
            throw new Pluf_Exception_DoesNotExist('given attachment is not blong to given order');
        }
        $response = new Pluf_HTTP_Response_File($attachment->getAbsloutPath(), $attachment->mime_type);
        return $response;
    }
    
    /**
     * Upload a file as order-attachment
     *
     * @param Pluf_HTTP_Request $request
     * @param array $match
     * @return object
     */
    public function upload($request, $match)
    {
        $order = null;
        if (isset($match['secureId'])) {
            $order = Shop_Shortcuts_GetObjectBySecureIdOr404('Shop_Order', $match['secureId']);
        } else {
            $order = Pluf_Shortcuts_GetObjectOr404('Shop_Order', $match['orderId']);
            // Check access to order
            if (! $this->canViewOrder($request, $order)) {
                return new Pluf_Exception_Unauthorized('You are not allowed to do this action.');
            }
        }
        Pluf::loadFunction('Pluf_Shortcuts_GetObjectOr404');
        $attachment = Pluf_Shortcuts_GetObjectOr404('Shop_OrderAttachment', $match['modelId']);
        if ($order->id != $attachment->get_order()->id) {
            throw new Pluf_Exception_DoesNotExist('given attachment is not blong to given order');
        }
        // Update the content of the attachment
        if (array_key_exists('file', $request->FILES)) {
            $extra = array(
                'model' => $attachment
            );
            $form = new Shop_Form_OrderAttachmentUpdate(array_merge($request->REQUEST, $request->FILES), $extra);
            $attachment = $form->save();
        } else {
            $myfile = fopen($attachment->getAbsloutPath(), "w") or die("Unable to open file!");
            $entityBody = file_get_contents('php://input', 'r');
            fwrite($myfile, $entityBody);
            fclose($myfile);
            $attachment->update();
        }
        return $attachment;
    }

    /**
     * The creator of an order (customer who registers the order) or owner of tenant 
     * can view the information of the order
     * @param Pluf_HTTP_Request $request
     * @param Shop_Order $order
     * @return boolean
     */
    public function canViewOrder($request, $order)
    {
        if (User_Precondition::isOwner($request)) {
            return true;
        }
        if (isset($request->user) && $request->user->id === $order->customer_id) {
            return true;
        }
        return false;
    }
    
    /**
     * Only the creator of an order (customer who registers the order) can modify the order
     * @param Pluf_HTTP_Request $request
     * @param Shop_Order $order
     * @return boolean
     */
    public function canModifyOrder($request, $order)
    {
        if (isset($request->user) && $request->user->id === $order->customer_id) {
            return true;
        }
        return false;
    }
}

