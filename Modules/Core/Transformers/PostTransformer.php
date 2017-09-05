<?php

namespace Modules\Core\Transformers;

class PostTransformer 
{
    public function transform($post)
    {
        return [
            'data' => $post['data'],
            'category' => $post['category']
            
        ];
    }

    public function transformDetail($post)
    {
        return [
            'data' => $post['data'],
            'post_category' => $post['post_category'],
            'all_category' => $post['category']
            
        ];
    }
}