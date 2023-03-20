<?php 

class User{
    public string $username;
    public string $email;
    public string $bio;
    public string $owner_image;

    public function __construct(string $username, string $email, string $bio, string $owner_image)
    {
        $this->username = $username;
        $this->email = $email;
        $this->bio = $bio;
        $this->owner_image = $owner_image;
    }
}

class UserActions
{
    function filteringData($username, $users)
    {
        foreach ($users as $user) {
            if ($user->username === $username) {
                return $user;
            }
        }
        return null;
    }
}

function getUser()
{
    $users_list = array();

    if (($handle = fopen("data/users.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            $user = new User($data[0], $data[1], $data[2], $data[3]);
            $users_list[] = $user;
        }
        fclose($handle);
    }

    $userActions = new UserActions;
    if(!empty($_GET['username'])){
        $user = $userActions->filteringData($_GET['username'], $users_list);
    } else{
        $user = $userActions->filteringData('Vilsivul', $users_list);
    }

    return $user;
}

?>