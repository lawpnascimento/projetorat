SELECT                rat.codRat
                     ,usu.codUsu
                     ,usu.nomUsu
                     ,usu.sobrenomeUsu
                     ,usu.perComCli
                     ,usu.perComInt
                     ,ati.codAti
                     ,ati.desAti
                     ,ati.datAti
                     ,ati.horIni
                     ,ati.horFin
                     ,cli.codCli
                     ,cli.nomCli
                     ,prj.nomPrj
                     ,pro.desPro
                     ,prj.vlrHorCom
                     ,prj.vlrHorFat
                     ,rsmati.SumHorTot
                     ,rsmati.SumFatTot
                     ,rsmati.SumBasCalCom
                     ,rsmati.SumComTot
                     FROM tbrat rat
                                     JOIN tbatividade ati
                                        ON ati.RAT_codRAT = rat.codRat
                                     JOIN tbfaturamento fat
                                         ON fat.RAT_codRAT = rat.codRat
                                                 JOIN tbresumoatividade rsmati
                                         ON rsmati.Faturamento_codFat = fat.codFat 
                                     JOIN tbusuario usu
                                       ON usu.codUsu = rat.Usuario_codUsu
                                     JOIN tbcliente cli
                                       ON cli.codCli = rat.Cliente_codCli
                                     JOIN tbresponsavel res 
                                       ON res.codRes = rat.Responsavel_codRes
                                     JOIN tbprojeto prj 
                                       ON prj.codPrj = rat.Projeto_codPrj
                                     JOIN tbproduto pro
                                       ON pro.codPro = rat.Produto_codPro
                                     JOIN tbsituacaorat sit
                                       ON sit.codSit = rat.Situacao_codSit 
               WHERE rat.Situacao_codSit = 4
                    AND fat.datFec BETWEEN '2017-09-11' AND '2017-09-11'
                    AND usu.codUsu = 1
                    AND cli.codCli = 1