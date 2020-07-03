

class President
{
    public $name = 'Barack Obama';

    public function greet(string $name): string
    {
        return sprintf('Hello %s, my name is Barack Obama, nice to meet you!', $name);
    }
}

$president_name = 'Barack Obama';
$us_president = new President();
$greetings_from_president = $us_president->greet('Donald');