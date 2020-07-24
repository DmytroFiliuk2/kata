<?php

class Person
{
    const species = 'Homo Sapiens';
    protected $name;
    protected $age;
    protected $occupation;

    public function __construct($name, $age, $occupation)
    {
        if (!is_string($name)) {
            throw new InvalidArgumentException('Name must be a string!');
        }

        if (!is_string($occupation)) {
            throw new InvalidArgumentException('Occupation must be a string!');
        }

        if ((int)$age <= 0) {
            throw new InvalidArgumentException('Age must be a non-negative integer!');
        }


        $this->name = $name;
        $this->age = $age;
        $this->occupation = $occupation;
    }

    public function introduce(): string
    {
        return sprintf('Hello, my name is %s', $this->name);
    }

    public function describe_job(): string
    {
        return sprintf('I am currently working as a(n) %s', $this->occupation);
    }

    public static function greet_extraterrestrials($species)
    {
        return sprintf('Welcome to Planet Earth %s!', $species);
    }

    /**
     * @return int
     */
    public function get_age()
    {
        return $this->age;
    }

    /**
     * @return string
     */
    public function get_name()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function get_occupation()
    {
        return $this->occupation;
    }

    /**
     * @param mixed $age
     */
    public function set_age($age)
    {
        if (!is_int($age) && $age <= 0) {
            throw new InvalidArgumentException('Age must be a non-negative integer!');
        }
        $this->age = $age;
    }

    /**
     * @param string $name
     */
    public function set_name($name)
    {
        if (!is_string($name)) {
            throw new InvalidArgumentException('Name must be a string!');
        }
        $this->name = $name;
    }

    /**
     * @param string $occupation
     */
    public function set_occupation($occupation)
    {
        if (!is_string($occupation)) {
            throw new InvalidArgumentException('Occupation must be a string!');
        }

        $this->occupation = $occupation;
    }
}
