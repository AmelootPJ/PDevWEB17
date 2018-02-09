<?php


class Personnage
{


	//Déclaration des variables
	private $_Nom;        	// Le nom du personnage
	private $_Force; 		// La force du personnage
	private $_DegatsArme;       // Les degats de l'arme du personnage : créer classe arme //
	private $_Degats;       // Les dégats du personnage
	private  $_Defense;     // La défense du personnage
	private $_PVie;			// Les points de vie du personnage
	private $_Experience;			// L'expérience du personnage

	public function __construct($pNom, $pForce, $pDegatsArme, $pPVie, $pDefense, $pExperience)
	{

		$this->_Nom = $pNom;
		$this->_Force = $pForce;
		$this->_DegatsArme = $pDegatsArme;
		$this->_Defense = $pDefense;
		$this->_PVie = $pPVie;
		$this->_Experience = $pExperience;

	}


	public function Frapper(personnage $pPerso)
	{		
			$this->SetDegats($this->_Force, $this->_DegatsArme, $pPerso->Getdefense());
			$pPerso->SetPvie($pPerso->GetPvie()- $this->GetDegats());

	}
	/* Nom */
	public function SetNom($pNom)
	{

		$this->_Nom = $pNom;

	}
	public function GetNom()
	{

		return $this->_Nom;

	}


	/* Force */
	public function SetForce($pForce)
	{

		$this->_Force = $pForce;
	}

	public function GetForce()
	{

		return $this->_Force;
	}

	/* Dégats de l'arme*/
	public function SetDegatsArme($pDegatsArme)
	{
			$this->_DegatsArme = $pDegatsArme;
	}

	public function GetDegatsArme()
	{

		return $this->_DegatsArme;

	}

	/* Dégats */
	private function SetDegats($pForce, $pDegatsArme, $pDefense)
	{
			$this->_Degats = $pForce + $pDegatsArme - $pDefense;

	}
	/*inutile*/
	public function GetDegats()
	{

		return $this->_Degats;

	}

	

	/* Défense */
	public function SetDefense($pDefense)
	{

		$this->_Defense = $pDefense;
	}

	public function GetDefense()
	{

		return $this->_Defense;
	}
	/* Points de vie */
		public function SetPVie($pPVie)
	{

		$this->_PVie = $pPVie;
	}

	public function GetPVie()
	{

		return $this->_PVie;
	}
	/* Expérience */
		public function SetExperience($pExperience)
	{

		$this->_Experience = $pExperience;
	}

	public function GetExperience()
	{

		return $this->_Experience;
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