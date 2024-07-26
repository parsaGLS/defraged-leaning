
<?php

class Product {
    protected string $name;
    protected int $price;
    protected array $options;

    public function __construct(string $name, int $price, array $options)
    {
        $this->name = $name;
        $this->price = $price;
        $this->options = $options;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    public function getOptions(): array
    {
        return $this->options;
    }
    public function setID(int $id): void{
        $this->options["id"] = $id;
    }
    public function setCount(int $count): void{
        $this->options["count"] = $count;
    }

    public function setOptions($options): void
    {
        $this->options[] = $options;
    }

}

class Shirt extends Product {
    private string $size;

    /**
     * @param string $size
     */



    public function getSize(): string
    {
        return $this->size;
    }

    public function setSize(string $size): void
    {
        $lowerCase_size=strtolower($size);
        $allowed_sizes = ["sm", "md", "lg", "xlg", "2xlg"];
        if (in_array($lowerCase_size, $allowed_sizes)) {
            $this->size = $size;
        } else {
            echo "wrong size";
        }
    }


}

class Pants extends Product {

    private int $size;

    public function getSize(): int
    {
        return $this->size;
    }

    public function setSize(int $size): void
    {
        if ($size>=30 && $size<=60) {
            $this->size = $size;
        }else{
            echo "wrong size";
        }
    }


}

class Shop {
    private array  $repo = [];
    private int $income = 0;
    private static int $id=1;

    public function addProduct(Product $product, int $count) : bool
    {
            $product->setID(self::$id);
            self::$id++;
            $product->setCount($count);
            $this->repo[] = $product;

        return true;
    }

    public function getSuggestion(string $type, $size, ?int $maxPrice, array $options = []) : array
    {
        $result=[];

        foreach ($this->repo as $product) {
            if ($product instanceof $type && $product->getSize() === $size && is_null($maxPrice)?true:($product->getPrice() <= $maxPrice) ) {
                if (empty(array_diff( $options,$product->getOptions()))) {
                    if ($product->getOptions()['count']>0){
                        $result[] = $product;
                    }
                }
            }
        }
        return $result;

    }

    public function sell(int $id) : Product
    {

        foreach ($this->repo as $product) {
            if ($product->getOptions()["id"] === $id) {
                if ($product->getOptions()['count']>0) {
                    $product->setCount($product->getOptions()['count']-1);
                    return $product;
                }else{
                    throw new Exception("product count is zero");
                }
            }
        }
        throw new Exception("product not found");
    }
}





//testing....
$shop=new Shop();
$shirt=new Shirt("kootah",1000,['ghermez']);
$shirt->setSize("md");
$pants=new Pants("boland",3000,['abi']);
$pants->setSize(40);
$shop->addProduct($shirt,10);
$shop->addProduct($pants,5);
$result=$shop->getSuggestion("Shirt","md",null,["ghermez"]);
echo "<pre>";
echo var_dump($result);
echo "</pre>";
$shop->sell(1);
$result=$shop->getSuggestion("Pants",40,null,[]);
echo "<pre>";
echo var_dump($result);
echo "</pre>";


