<?php
 
class Connection
{
  private PDO $pdo;

  public function __construct()
  {
    $this->pdo = new PDO("mysql:host=localhost;dbname=canard-streaming", "root", "");
  }

  public function insertU(User $user): bool
  {
    $query = 'INSERT INTO user (email,pseudo, password)
              VALUES (:email, :pseudo, :password)';
    $statement = $this->pdo->prepare($query);

    return $statement->execute([
      'email' => $user->email,
      'password' => md5($user->password . 'SALT'),
      'pseudo' => $user->firstname
    ]);


  }




  public function loginuser($email, $password): bool|array
  {
    $log = $this->pdo->prepare('SELECT * FROM user WHERE email ="' . $email . '"');
    $log->execute();

    $result = $log->fetchAll(PDO::FETCH_ASSOC)[0];

    if (md5($password . 'SALT') === $result['password']) {

      return $result;
    } else {
      return false;
    }
  }
  public function SfD($idfilm , $iduser){
      $log = $this->pdo->prepare('SELECT * FROM movie_wanted WHERE user_id ="' . $iduser . '"');
      $log->execute();

      $result = $log->fetchAll(PDO::FETCH_ASSOC);
      foreach ($result as $movie){
          if ($movie['movie_id'] == $idfilm){
              return true;
          }

      }
      return false;
  }
    public function SfS($idfilm , $iduser){
        $log = $this->pdo->prepare('SELECT * FROM movie_see WHERE user_id ="' . $iduser . '"');
        $log->execute();

        $result = $log->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $movie) {
            if ($movie['movie_id'] == $idfilm) {
                return true;
            }

        }
            return false;

    }
  public function Newview($idfilm , $iduser){
      $query = 'INSERT INTO movie_see (user_id, movie_id)
              VALUES (:userid, :filmid)';
      $statement = $this->pdo->prepare($query);

      return $statement->execute([
          'userid' => $iduser,
          'filmid' => $idfilm
      ]);
  }

    public function Newdream($idfilm , $iduser){
        $query = 'INSERT INTO movie_wanted (user_id, movie_id)
              VALUES (:userid, :filmid)';
        $statement = $this->pdo->prepare($query);

        return $statement->execute([
            'userid' => $iduser,
            'filmid' => $idfilm
        ]);
    }

    public function dreamD($idfilm , $iduser){
        $log = $this->pdo->prepare('DELETE FROM movie_wanted WHERE user_id ="' . $iduser . '" AND movie_id =" '. $idfilm . '"' );
        $log->execute();
    }
    public function Dview($idfilm , $iduser){
        $log = $this->pdo->prepare('DELETE FROM movie_see WHERE user_id ="' . $iduser . '" AND movie_id =" '. $idfilm . '"' );
        $log->execute();
    }

  public function creataalbum($album_name, $private)
  {
    $query = 'INSERT INTO album (album_name, private)
    VALUES (:album_name, :private)';
    $statement = $this->pdo->prepare($query);
    if ($statement->execute([
      'album_name' => $album_name,
      'private' => $private
    ])) {
      echo 'Données enregistrées avec succès !';
    } else {
      echo "Erreur lors de l'enregistrement des données";
    };
    $album_id = $this->pdo->lastInsertId();
    echo $album_id;
    $query = 'INSERT INTO user_album (user_id, album_id)
    VALUES (:user_id, :album_id)';
    $statement = $this->pdo->prepare($query);
    if ($statement->execute([
      'user_id' => $_SESSION['user']['id'],
      'album_id' => $album_id
    ])) {
      echo 'Données linker avec succès !';
    } else {
      echo "Erreur lors du linkage des données";
    };
  }
  public function getmyalbum()
  {
    $query = 'SELECT album_name
    FROM user_album AS ua
    JOIN album AS a ON ua.album_id = a.album_id
    JOIN `user` AS u ON u.id = ua.user_id
    WHERE u.id = :user_id';
    $statement = $this->pdo->prepare($query);
    $statement->execute([
      'user_id' => $_SESSION['user']['id']
    ]);
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }
  public function getalbumcontent($album_name)
  {
    $query = 'SELECT album_content
    FROM album 
    WHERE album_name = :album_name';
    $statement = $this->pdo->prepare($query);
    $statement->execute([
      'album_name' => $album_name
    ]);
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  public function addfilmtoalbum($album_name, $film_id){
    $query = 'UPDATE album
    SET album_content = CONCAT(album_content,  " " ,:film_id)
    WHERE album_name = :album_name';
    $statement = $this->pdo->prepare($query);
    if ($statement->execute([
      'album_name' => $album_name,
      'film_id' => $film_id
    ])) {
      echo 'Données enregistrées avec succès !';
    } else {
      echo "Erreur lors de l'enregistrement des données";
    };
  }

  public function getmovibyID($film_id){
    $query = 'SE';
    $statement = $this->pdo->prepare($query);
    if ($statement->execute([
    ])) {
      echo 'Données enregistrées avec succès !';
    } else {
      echo "Erreur lors de l'enregistrement des données";
    };
  }

  public function GMovieS($u_id){
      $log = $this->pdo->prepare('SELECT movie_id FROM movie_see WHERE user_id = "' . $u_id . '" LIMIT 4');
      $log->execute();
      return $result = $log->fetchAll(PDO::FETCH_ASSOC);
  }


  public function GMovieD($u_id){
      $log = $this->pdo->prepare('SELECT movie_id FROM movie_wanted WHERE user_id = "' . $u_id . '" LIMIT 4');
      $log->execute();
      return $result = $log->fetchAll(PDO::FETCH_ASSOC);
  }

  public function GMovieSA($u_id){
      $log = $this->pdo->prepare('SELECT movie_id FROM movie_see WHERE user_id = "' . $u_id . '"');
      $log->execute();
      return $result = $log->fetchAll(PDO::FETCH_ASSOC);
  }


  public function GMovieDA($u_id){
      $log = $this->pdo->prepare('SELECT movie_id FROM movie_wanted WHERE user_id = "' . $u_id . '"');
      $log->execute();
      return $result = $log->fetchAll(PDO::FETCH_ASSOC);
  }
}