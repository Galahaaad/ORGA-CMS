<?php

namespace App;
use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/../.env');
class Api {

private $data;
private $apiKey;
private $userName;
private $erreur;

private static function cURL($url) {
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$response = curl_exec($ch);
curl_close($ch);
return json_decode($response);
}

public function __construct($userName) {
$this->userName = $userName;
$this->apiKey = getenv('API_KEY');
$this->data = Api::cURL("https://api.habbocity.me/avatar_info.php?key=Irone_8798&user=".$this->userName."&selectedBadges&wealth&rooms&lastTweets&statistics");
$this->checkErreur();
}
    public function getPlayingTime(): int {
        return $this->getProperty('statistics')->playingTime ?? 0;
    }

    public function getRespects(): int {
        return $this->getProperty('statistics')->respects ?? 0;
    }

    public function getChatCount(): int {
        return $this->getProperty('statistics')->chatCount ?? 0;
    }

    public function getBuildCount(): int {
        return $this->getProperty('statistics')->buildCount ?? 0;
    }

    public function getVisitedRooms(): int {
        return $this->getProperty('statistics')->visitedRooms ?? 0;
    }

    public function getPrivateChatCount(): int {
        return $this->getProperty('statistics')->privateChatCount ?? 0;
    }

    public function getMovementsCount(): int {
        return $this->getProperty('statistics')->movementsCount ?? 0;
    }
    public function getWinWins(): int {
        return $this->getProperty('winwins', 0);
    }

private function getProperty(string $property, $default = null) {
return property_exists($this->data, $property) ? $this->data->$property : $default;
}

public function getId(): int {
return $this->getProperty('uniqueId', 0);
}

public function getName(): string {
return $this->getProperty('name', 'Nom inconnu');
}

public function getMission(): string {
return $this->getProperty('motto', 'Mission non définie');
}

public function getAvatar(): string {
return $this->getProperty('avatar', 'Avatar indisponible');
}

public function getOnline(): bool {
return $this->getProperty('online', false);
}

public function getRegister(): int {
return $this->getProperty('register', 0);
}

public function getDiamonds(): int {
return $this->getProperty('diamonds', 0);
}

public function getRooms(): array {
return $this->getProperty('rooms', []);
}

public function getWealth(): array {
return $this->getProperty('wealth', []);
}

public function __toString(): string {
return $this->getProperty('wealth')->date ?? 'Date indisponible';
}

public function getListBadge(): ?array {
return $this->getProperty('selectedBadges', []);
}

public function getListGroupe(): ?array {
return $this->getProperty('joinGroup', []);
}

private function checkErreur(): void {
if ($this->data == null) {
$this->erreur = "Nous n'avons pas réussi à effectuer la requête vers le serveur d'HabboCity.";
} else {
// Décommenter si l'API renvoie explicitement des erreurs
/*
if (property_exists($this->data, 'type') && $this->data->type == "error") {
$this->erreur = $this->data->message;
}
*/
}
}

public function getErreur() {
return $this->erreur;
}
}