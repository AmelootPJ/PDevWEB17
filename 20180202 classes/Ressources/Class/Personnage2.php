<?php


class Personnage2
{


	//Déclaration des variables
	private $_Nom;        // La force du personnage
	private $_Force;        // La force du personnage
	private $_Degats;        // La force du personnage
	private  $_Defense;        // La force du personnage
	private $_PVie;

	public function __construct($pNom, $pForce, $pDegatsArme, $pPVie, $pDefense)
	{

		$this->_Nom = $pNom;
		$this->_Force = $pForce;
		$this->_PVie = $pPVie;
		$this->_Defense = $pDefense;

		$this->_Degats = $pForce + $pDegatsArme;
		echo 'force :' . $pForce . '<br>';
		echo 'degarmes : :' . $pDegatsArme. '<br>';
		echo 'degats :' . $Degats. '<br>';

	}



	public function Frapper(personnage2 $pPerso)
	{

			echo $this->_getDegats();

	}


	private function SetDegats($pForce, $pDegatsArme)
	{


	}

	private function GetDegats()


	{

		return self::$_Degats;

	}

	public function SetNom($pNom)

	{

		$this->_Nom = $pNom;

	}
	public function GetNom()

	{

		return $this->_Nom;

	}

	public function GetForce()

	{

		return $this->_Force;
	}

	public function GetDéfense()
	{

		return $this->_Defense;
	}

	public function GetPvie()
	{

		return $this->_PVie;
	}



	public function hydrate(array $donnees)
	{
		foreach ($donnees as $key => $value)
		{
			$method = 'set'.ucfirst($key);

			if (method_exists($this, $method)):
				{
					$this->$method($value);
				}
			endif;
		}
	}
}