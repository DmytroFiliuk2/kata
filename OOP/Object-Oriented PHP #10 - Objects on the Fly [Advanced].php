<?php

$object_oriented_php = new class(
    "An amazing PHP Kata Series, complete with 10 top-quality Kata containing a large number of both fixed and random tests, that teaches both the fundamentals of object-oriented programming in PHP (in the first 7 Kata of this Series) and more advanced OOP topics in PHP (in the last 3 Kata of this Series) such as interfaces, abstract classes and even anonymous classes in a way that stimulates critical thinking and encourages independent research",
    array(
        'Object-Oriented PHP #1 - Classes, Public Properties and Methods',
        'Object-Oriented PHP #2 - Class Constructors and $this',
        'Object-Oriented PHP #3 - Class Constants and Static Methods',
        'Object-Oriented PHP #4 - People, people, people (Practice)',
        'Object-Oriented PHP #5 - Classical Inheritance',
        'Object-Oriented PHP #6 - Visibility',
        'Object-Oriented PHP #7 - The "Final" Keyword',
        'Object-Oriented PHP #8 - Interfaces [Advanced]',
        'Object-Oriented PHP #9 - Abstract Classes [Advanced]',
        'Object-Oriented PHP #10 - Objects on the Fly [Advanced]',
    ),
    10,
    new class("Donald", 17, "Male", 'Computer Programmer') {
        public $name, $age, $occupation, $gender; // Public Properties.  You can also define protected and private properties if necessary.

        public function __construct($name, $age, $gender, $occupation)
        {
            /* Class constructor, just like any other class */
            $this->name = $name;
            $this->age = $age;
            $this->occupation = $occupation;
            $this->gender = $gender;
        }
    }
) {
    public $description, $kata_list, $kata_count, $author;// Public Properties.  You can also define protected and private properties if necessary.

    public function __construct($description, $kata_list, $kata_count, $author)
    {
        /* Class constructor, just like any other class */
        $this->description = $description;
        $this->kata_list = $kata_list;
        $this->kata_count = $kata_count;
        $this->author = $author;
    }

    /* An actual say_hello() method!  You can also define protected and private methods if necessary */
    public function advertise($name)
    {
        return "Hey $name, don't forget to check out this great PHP Kata Series authored by Donald called \"Object - Oriented PHP\"";
    }

    public function get_kata_by_number($kata_number)
    {
        if (!is_int($kata_number) || $kata_number < 0 || $kata_number > 10) {
            throw new InvalidArgumentException('Age must be a non-negative integer!');
        }

        return $this[$kata_number];
    }

    public function complete()
    {
        return 'Hooray, I\'ve finally completed the entire \"Object-Oriented PHP\" Kata Series!!!';
    }

    public function __serialize(): array
    {
        return $this->description;
    }

    public function __toString(): string
    {
        return $this->description;
    }
};

