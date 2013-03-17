<?php
require_once "phing/Task.php";

class GetVersion extends Task
{
	protected $propertyname;

	protected $filename;

	public function setPropertyname($propertyname)
	{
		$this->propertyname = $propertyname;
	}

	public function setFilename($filename)
	{
		$this->filename = $filename;
	}

	public function init()
	{
	}

	public function main()
	{
		if (file_exists($this->filename))
		{
			// preset the property
			$this->project->setProperty($this->propertyname, "");

			// read the version text file in to a variable
			$contents = file_get_contents($this->filename);
			preg_match_all("/<\s*version[^>]*>([^<]*)<\s*\/\s*version\s*>/", $contents,$match);
			if (!empty($match[1]))
			{
				$this->project->setProperty($this->propertyname, $match[1][0]);
			}
		}
	}
}

