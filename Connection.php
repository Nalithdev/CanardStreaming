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
    $query = 'INSERT INTO user (email, password, pseudo)
              VALUES (:email, :password, :pseudo)';
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