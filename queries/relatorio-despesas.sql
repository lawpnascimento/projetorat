SELECT                usu.codUsu
                     ,usu.nomUsu
                     ,usu.sobrenomeUsu
                     ,rat.codRat
                     ,cli.codCli
                     ,cli.nomCli
                            ,dsp.desDsp
                            ,dsp.vlrDsp
                            ,dsprat.Despesa_codDsp
                            ,dsprat.datDsp
                            ,dsprat.qtdDsp
                            ,dsprat.totDsp
                 FROM tbrat rat
                 JOIN tbusuario usu
                    ON usu.codUsu = rat.Usuario_codUsu
                 JOIN tbdespesarat dsprat
                    ON dsprat.RAT_codRAT = rat.codRat
                 JOIN tbdespesa dsp
                      ON dsp.codDsp = dsprat.Despesa_codDsp
                 JOIN tbcliente cli
                    ON cli.codCli = rat.Cliente_codCli
               WHERE CODUSU=7