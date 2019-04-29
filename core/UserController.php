<?PHP
class UserController {
	function addUser($user) {
		
			$sql = "insert into user (id,username,name,surname,email,password,role,number) values (
				:id, :username, :name, :surname, :email, :password, :role, :number)";
		$db = Config::getConnexion();
		try{
        $req=$db->prepare($sql);
		
		$id=$user->getId();
        $username=$user->getUsername();
        $name=$user->getName();
        $surname=$user->getSurname();
        $email=$user->getEmail();
        $password=$user->getPassword();
        $role=$user->getRole();
        $number=$user->getNumber();
        $req->bindValue(':id',$id);
		$req->bindValue(':username',$username);
		$req->bindValue(':name',$name);
		$req->bindValue(':surname',$surname);
		$req->bindValue(':email',$email);
		$req->bindValue(':password',$password);
		$req->bindValue(':role',$role);
		$req->bindValue(':number',$number);
		
		
            $req->execute();
           return true;
        }
        catch (Exception $e){
        	return null;
            echo 'Erreur: '.$e->getMessage();
        }
		
	}

	function deleteUser($user){
		$sql="delete from user where id=".$user->getId();
		$this->executeSql($sql);
		return $sql;
	}

	function findUser($email,$password){
		$sql="SELECT * from user where email='".$email."' and password='".$password."' LIMIT 1";
		$db = Config::getConnexion();
		try{
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$row = $stmt->fetch();
			if(empty($row["id"]))
				return null;
			else{
				$user = new User();
				$user->setName($row["name"]);
				$user->setSurname($row["surname"]);
				$user->setRole($row["role"]);
				$user->setUsername($row["username"]);
				$user->setId($row["id"]);
				$user->setEmail($row["email"]);
				$user->setNumber($row["number"]);
				return $user;
			}
		}
        catch (Exception $e){
            return $e->getMessage().' '.$sql;
        }
	}

	function executeSql($sql){
		$db = Config::getConnexion();
		$req=null;
		try{
			$req=$db->prepare($sql);
			$s=$req->execute();
		}
		catch (Exception $e){
			var_dump(" Erreur ! ".$e->getMessage());
		}
	}

	function afficherUsers(){
		//$sql="SElECT * From employe e inner join formationphp.employe a on e.cin= a.cin";
		$sql="SElECT * from user";
		$db = Config::getConnexion();
		try{
		$liste=$db->query($sql);
		return $liste;
		}
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }	
	}
}
