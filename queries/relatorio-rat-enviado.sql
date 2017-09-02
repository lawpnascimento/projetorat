SELECT                usu.codUsu
                     ,usu.nomUsu
                     ,usu.sobrenomeUsu
                     ,usu.senUsu
                     ,usu.codSit
                     ,usu.desEml
                     ,usu.perCom
                     ,rat.codRat
                     ,ati.codAti
                     ,ati.desAti
                     ,ati.datAti 
                     ,DATE_FORMAT(ati.horIni,'%H:%i') horIni
                     ,DATE_FORMAT(ati.horFin,'%H:%i') horFin
                     ,ati.tipFat
                     ,cli.codCli
                     ,cli.nomCli
                     ,prj.codPrj
                     ,prj.nomPrj
                     ,prj.vlrHor
                 FROM tbrat rat
                 JOIN tbusuario usu
                    ON usu.codUsu = rat.Usuario_codUsu
                 JOIN tbatividade ati
                    ON ati.RAT_codRAT = rat.codRat
                 JOIN tbcliente cli
                      ON cli.codCli = rat.Cliente_codCli
                 JOIN tbprojeto prj
                         ON prj.codPrj = rat.Projeto_codPrj
               WHERE CODUSU=1