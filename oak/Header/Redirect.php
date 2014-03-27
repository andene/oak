<?hh namespace Oak\Header;

class Redirect {

    public static function to(string $location, ?int $responseCode):void {

        header("Location: $location", false, $responseCode);

    }

}
