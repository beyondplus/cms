<?php

namespace Modules\Core\Transformers;

class TaxTransformer 
{
    public function transform($tax)
    {
        return [
            'data' => $tax['data'],
            'all' => $tax['all']
            
        ];
    }
}