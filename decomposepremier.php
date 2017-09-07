<?php 
session_start();

if (isset($_POST['nombre']))
{
	$n=ltrim($_POST['nombre'],"0");

	if (!is_numeric($n)||!is_int($n/1))
	{
		$reponse='Il faut un nombre entier !!';
	}
	elseif ($n<=0)
	{
		$reponse='Il faut un entier positif !!';
	}
	elseif ($n==1)
	{
		$reponse='Comme dit dans la remarque : <br> 1 n\'est pas consid&eacute;r&eacute; comme premier';
	}
	else
	{
		$m=number_format($n, 0, ',', ' ');
		$i=2;
		while ($n%$i!=0 AND $i<sqrt($n))
		{
			$i++;
		}
		if ($i>sqrt($n))
		{
			$reponse='Pas de d&eacute;composition : '.$m.' est premier';
		}
		else
		{
			$n=$n/$i;
			$liste[$i]=1;
			$premier=FALSE;
			while (!$premier)
			{
				while ($n%$i!=0 AND $i<sqrt($n))
				{
					$i++;
				}
				if ($i>sqrt($n))
				{
					$premier=TRUE;
					if (array_key_exists($n,$liste))
					{
						$liste[$n]++;
					}
					else
					{
						$liste[$n]=1;
					}
				}
				else
				{
					$premier=FALSE;
					if (array_key_exists($i,$liste))
					{
						$liste[$i]++;
					}
					else
					{
						$liste[$i]=1;
					}
					$n=$n/$i;
				}
			}
			
			$result='';
			$y=0;
			foreach($liste as $nombre => $puissance)
			{
				if ($y==0)
				{
					if ($puissance==1)
					{
						$result.='' . $nombre . '';
					}
					else
					{
						$result.='' . $nombre . '<sup>' . $puissance . '</sup>';
					}
					$y=1;
				}
				else
				{
					if ($puissance==1)
					{
						$result.=' x ' . $nombre . '';
					}
					else
					{
						$result.=' x ' . $nombre . '<sup>' . $puissance . '</sup>';
					}
				}
			}
			$reponse='La d&eacute;composition de '.$m.' est : <br />'.$m.' = '.$result.'';
		}
	}
//$_SESSION['reponse'] = $reponse;
echo $reponse;
}
?>