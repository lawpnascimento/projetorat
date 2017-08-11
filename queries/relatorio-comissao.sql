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
                     ,ati.horIni
                     ,ati.horFin
                     ,cli.codCli
                     ,cli.nomCli
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
               WHERE CODUSU=7