<?php

abstract class Person
{
    public $name;
    public $age;
    public $gender;

    public function __construct($name, $age, $gender)
    {
        if (!is_string($name)) {
            throw new InvalidArgumentException('Name must be a string!');
        }

        if (!is_string($gender)) {
            throw new InvalidArgumentException('Occupation must be a string!');
        }

        if (!is_int($age) || $age < 0) {
            throw new InvalidArgumentException('Age must be a non-negative integer!');
        }

        $this->name = $name;
        $this->age = $age;
        $this->gender = $gender;
    }

    abstract public function introduce();

    public function greet($name)
    {
        return "Hello $name";
    }
}

final class Child extends Person
{
    public $aspirations;

    public function __construct($name, $age, $gender, array $aspirations)
    {
        $this->aspirations = $aspirations;
        parent::__construct($name, $age, $gender);
    }

    public function introduce()
    {
        return "Hi, I'm $this->name and I am $this->age years old";
    }

    public function greet($name)
    {
        return "Hi $name, let's play!";
    }

    public function say_dreams()
    {
        return sprintf('I would like to be a(n) %s when I grow up.', say_list($this->aspirations));
    }
}

class ComputerProgrammer extends Person
{
    public $occupation;

    public function __construct($name, $age, $gender)
    {
        parent::__construct($name, $age, $gender);
        $this->occupation = 'Computer Programmer';
    }

    public function introduce()
    {
        return "Hello, my name is $this->name, I am $this->age years old and I am a(n) $this->occupation";
    }

    public function greet($name)
    {
        return "Hello $name, I'm $this->name, nice to meet you";
    }

    public function advertise()
    {
        return "Don't forget to check out my coding projects";
    }
}