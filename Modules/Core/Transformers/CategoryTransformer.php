<?php

namespace Modules\Core\Transformers;

class CategoryTransformer 
{
    public function transform($category)
    {
        return [
            'data' => $category['data'],
            'all' => $category['all']
            
        ];
    }
}