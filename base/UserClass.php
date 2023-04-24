<?php 
session_start();
class User{
    public string $email;
    public string $username;
    public string $bio;
    public string $avatar;
    public string $twitter;
    public string $instagram;
    public string $facebook;
    public string $social;

    public function __construct(string $username, string $email, string $bio, string $avatar, string $twitter, string $instagram, string $facebook, string $social)
    {
        $this->username = $username;
        $this->email = $email;
        $this->bio = $bio;
        $this->avatar = $avatar;
        $this->twitter = $twitter;
        $this->instagram = $instagram;
        $this->facebook = $facebook;
        $this->social = $social;
    }
}

function getUser($conn)
{
    $email = $_SESSION["email"];
    $stmt = $conn->prepare("SELECT * FROM User WHERE email = '$email'");
    $stmt->execute();

    $result = $stmt->get_result();
    $user_data = $result->fetch_assoc();
    $username = $user_data["username"];
    $email = $user_data["email"];
    $bio = isset($user_data["bio"]) ? $user_data["bio"] : "";
    $avatar = isset($user_data["avatar"]) ? $user_data["avatar"] : "img/avatars/default.png";
    $twitter = isset($user_data["twitter"]) ? $user_data["twitter"] : "";
    $instagram = isset($user_data["instagram"]) ? $user_data["instagram"] : "";
    $facebook = isset($user_data["facebook"]) ? $user_data["facebook"] : "";
    $social = isset($user_data["social"]) ? $user_data["social"] : "";

    $user = new User($username, $email, $bio, $avatar, $twitter, $instagram, $facebook, $social);

    $stmt->close();
    $conn->close();
    return $user;

}

?>