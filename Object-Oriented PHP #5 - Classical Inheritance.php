
class Salesman extends Person
{
    const species = 'Homo Sapiens';
    public $name;
    public $age;
    public $occupation;

    public function __construct($name, $age)
    {
        parent::__construct($name, $age, 'Salesman');
    }

    public function introduce(): string
    {
        return sprintf('Hello, my name is %s, don\'t forget to check out my products!', $this->name);
    }
}


class ComputerProgrammer  extends Person
{
    const species = 'Homo Sapiens';
    public $name;
    public $age;
    public $occupation;

    public function __construct($name, $age)
    {
        parent::__construct($name, $age, 'Computer Programmer');
    }

    public function introduce(): string
    {
        return sprintf('Hello, my name is %s, don\'t forget to check out my products!', $this->name);
    }

    public function describe_job(): string
    {
        return sprintf('I am currently working as a(n) %s, don\'t forget to check out my Codewars account ;)', $this->occupation);
    }
}


class WebDeveloper extends ComputerProgrammer
{
    const species = 'Homo Sapiens';
    public $name;
    public $age;
    public $occupation;

    public function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
        $this->occupation = 'Web Developer';
    }

    public function describe_job(): string
    {
        return sprintf(
            'I am currently working as a(n) %s, don\'t forget to check out my Codewars account ;) And don\'t forget to check on my website :D',
            $this->occupation
        );
    }

    public function describe_website(): string
    {
        return 'My professional world-class website is made from HTML, CSS, Javascript and PHP!';
    }
}
