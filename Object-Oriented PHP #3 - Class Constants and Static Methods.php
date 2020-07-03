

class CurrentUSPresident
{
    public const name = 'Barack Obama';

    public static function greet(string $name): string
    {
        return sprintf('Hello %s, my name is Barack Obama, nice to meet you!', $name);
    }
}

$president_name = 'Donald';
$greetings_from_president = CurrentUSPresident::greet(CurrentUSPresident::name);