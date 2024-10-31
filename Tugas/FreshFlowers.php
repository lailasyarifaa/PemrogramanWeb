<?php

// Define the namespace
namespace FloristSystem;

// Abstract Class - Defines a basic Flower structure
abstract class Flower {
    protected $name;
    protected $color;

    public function __construct($name, $color) {
        $this->name = $name;
        $this->color = $color;
    }

    // Abstract method to get flower information
    abstract public function getInfo();
}

// Trait - Handles pricing functionality for flowers
trait PricingTrait {
    private $price;

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getPrice() {
        // Format price in IDR
        return "Rp " . number_format($this->price, 0, ',', '.');
    }
}

// Concrete Class - Extends Flower class for bouquet arrangements
class Bouquet extends Flower {
    use PricingTrait;

    private $flowerCount;

    public function __construct($name, $color, $flowerCount) {
        parent::__construct($name, $color);
        $this->flowerCount = $flowerCount;
    }

    // Implementation of abstract method
    public function getInfo() {
        return "{$this->name} Bouquet, Color: {$this->color}, Count: {$this->flowerCount} flowers";
    }

    // Optional Magic Method
    public function __toString() {
        return $this->getInfo() . ", Price: " . $this->getPrice();
    }
}

// Concrete Class - Extends Flower class for single flowers
class SingleFlower extends Flower {
    use PricingTrait;

    public function getInfo() {
        return "Single {$this->name}, Color: {$this->color}";
    }

    public function __toString() {
        return $this->getInfo() . ", Price: " . $this->getPrice();
    }
}

// Using Classes and Traits
$bouquet = new Bouquet("Rose", "Red", 12);
$bouquet->setPrice(25990); // Set price in IDR
echo $bouquet;

echo "\n";

$singleFlower = new SingleFlower("Tulip", "Yellow");
$singleFlower->setPrice(3990); // Set price in IDR
echo $singleFlower;

?>
