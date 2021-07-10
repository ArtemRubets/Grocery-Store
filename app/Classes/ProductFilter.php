<?php


namespace App\Classes;



use App\Http\Requests\CategoryFilterRequest;

class ProductFilter
{
    protected $collection;
    protected $request;

    /**
     * ProductFilter constructor.
     * @param $categoryProducts
     * @param CategoryFilterRequest $request
     */
    public function __construct($categoryProducts, CategoryFilterRequest $request)
    {
        $this->collection = $categoryProducts;
        $this->request = $request;
    }

    public function apply()
    {
        foreach ($this->filters() as $filter => $value){
            if (method_exists($this, $filter)){
                $this->$filter($value);
            }
        }

        return $this->collection;
    }

    public function filters()
    {
        return $this->request->all();
    }

    public function price_from($value)
    {
        if (!$value) return;
        $this->collection = $this->collection->where('product_price', '>', $value);
    }

    public function price_to($value)
    {
        if (!$value) return;
        $this->collection = $this->collection->where('product_price', '<', $value);
    }

    public function is_offer($value)
    {
        if ($value == 1){
            $this->collection = $this->collection->where('is_offer', $value);
        }
    }
}
