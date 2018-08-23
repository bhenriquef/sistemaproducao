valp = [[]]; valm = [[]]; valg = [[]]; //vetores das grades P M G
valmat = [[]]; rendimento = 0; numpeca = 0; //vetor dos materiais(valmat), valor do rendimento (rendimento), numero de peças(numpeca)
numpassado = [[]]; precomat = 0; matpassado = [[]]; //vetor dos numeros que entraram(numpassado), valor do material (precomat), material que entrou(matpassado)
forro = 0; entretela = 0; corte = 0; //numero de tecido para forro (forro) , para entretela (entretela) e valor do corte (corte)
costura = 0; //valor da costura (costura)
function calcular(nome, tipo) { //funçao para calcular o valor da peça pos corte, nome = id do input, tipo = ao que aquele input pertence
    if(tipo == 'corp'){ // confere se é a grade p
        for(i = 0; i < 10; i++){
            if(parseFloat(document.getElementById(nome).value, 100) != valp[i][1] && nome == valp[i][0]){ //confere se o o valor é diferente mas o nome é igual
                valp[i][1] = parseFloat(document.getElementById(nome).value, 100); // se for ele troca para o valor atual
                break; //força a saida do for
            }
            else if(parseFloat(document.getElementById(nome).value, 100) == valp[i][1] && nome == valp[i][0]){ //se o nome e o valor for igual ele sai do for
                break; //força a saida do for
            }
            else if(valp[i][0] == null && valp[i][1] == null){ //confere se nao a valor na posiçao i do vetor valp
                valp[i][0] = nome; //insere o nome no vetor valp
                valp[i][1] = parseFloat(document.getElementById(nome).value, 100); //insere o valor no vetor valp
                valp.push([]); //insere uma nova casa vazia no vetor (para que ele continue inserindo novos valores)
                break; //força a saida do for
            }

        } //fim do for
    } //fim do if(tipo == corp)

    else if(tipo == 'corm'){ //confere se é a grade m
        for(i = 0; i < 10; i++){
            if(parseFloat(document.getElementById(nome).value, 100) != valm[i][1] && nome == valm[i][0]){ //confere se o o valor é diferente mas o nome é igual
                valm[i][1] = parseFloat(document.getElementById(nome).value, 100); // se for ele troca para o valor atual
                break; //saida do for
            }
            else if(parseFloat(document.getElementById(nome).value, 100) == valm[i][1] && nome == valm[i][0]){ //se o nome e o valor for igual ele sai do for
                break; //força a saida do for
            }
            else if(valm[i][1] == null && valm[i][0] == null){ //confere se nao a valor na posiçao i do vetor valm
                valm[i][0] = nome; //insere o nome no vetor valm
                valm[i][1] = parseFloat(document.getElementById(nome).value, 100); //insere o valor no vetor valm
                valm.push([]); //insere uma nova casa vazia no vetor (para que ele continue inserindo novos valores)
                break; //força a saida do for
            }

        } //fim do for
    } //fim do else if(tipo == corm)

    else if(tipo == 'corg'){ //confere se é a grade g
        for(i = 0; i < 10; i++){
            if(parseFloat(document.getElementById(nome).value, 100) != valg[i][1] && nome == valg[i][0]){ //confere se o valor é diferente mas o nome é igual
                valg[i][1] = parseFloat(document.getElementById(nome).value, 100); //se for ele troca para o valor atual
                break; //força a saida do for
            }
            else if(parseFloat(document.getElementById(nome).value, 100) == valg[i][1] && nome == valg[i][0]){ //se o nome e o valor for igual ele sai do for
                break; //força a saida do for
            }
            else if(valg[i][1] == null && valg[i][0] == null){ //confere se nao a valor na posicao i do vertor valg
                valg[i][0] = nome; //insere o nome no vetor valg
                valg[i][1] = parseFloat(document.getElementById(nome).value, 100); //insere o valor no vetor valg
                valg.push([]); //insere uma nova casa vazia no vetor (para que ele continue inserindo novos valores)
                break; //força a saida do for
            }
        } //fim do for
    } //fim do else if(tipo == corg)

    else if(tipo == 'material'){ //confere se é o material
        for(i = 0; i < 10; i++){
            if(parseFloat(document.getElementById(nome).value, 100) != valmat[i][1] && nome == valmat[i][0]){ //confere se o valor é diferente mas o nome é igual
                valmat[i][1] = parseFloat(document.getElementById(nome).value, 100); //se for ele troca para o valor atual
                break; //força a saida do for
            }
            else if(parseFloat(document.getElementById(nome).value, 100) == valmat[i][1] && nome == valmat[i][0]){ //se o nome e o valor for igual ele sai do for
                break; //força a saida do for
            }
            else if(valmat[i][1] == null && valmat[i][0] == null){ //confere se nao a valor na posiçao i do vertor valmat
                valmat[i][0] = nome; //insere o nome no vetor valmat
                valmat[i][1] = parseFloat(document.getElementById(nome).value, 100); //insere o valor no vetor valmat
                valmat[i][2] = parseFloat(document.getElementById("idq"+i).value, 1000); //insere a quantidade no vetor valmat
                valmat.push([]); //insere uma nova casa vazia no vetor (para que ele continue inserindo novos valores)
                break; //força a saida do for
            }
        } //fim do for
    } //fim do else if(tipo == 'material')

    else if(tipo == 'rendimento'){ //confere se é o rendimento
        rendimento = parseFloat(document.getElementById(nome).value, 100); //pega o valor do rendimento
    }

    else if(tipo == 'forro'){ //confere se é o forro
        forro = parseFloat(document.getElementById(nome).value, 100); //pega o valor do forro
    }

    else if(tipo == 'entretela'){ //confere se é a entretela
        entretela = parseFloat(document.getElementById(nome).value, 100); //pega o valor do forro
    }

    else if(tipo == 'cortador'){ //confere se é o corte
        corte = parseFloat(document.getElementById(nome).value, 100); //pega o valor do corte
    }

    else if(tipo == 'costureira'){ //confere se é a costura
        costura = parseFloat(document.getElementById(nome).value, 100); //pega o valor da costura
    }

    if(rendimento != 0 && valp.length != 0 && valm.length != 0 && valg.length != 0) { //confere se o rendimento e a grade
            for (i = 0; i < valp.length; i++) { //for para rodar o array da grade P
                if (valp[i][0] == null && valm[i][0] == null && valg[i][0] == null) { //confere se a proxima posiçao dos 3 arrays esta vazia
                    valp.splice(i, 1); //apaga a casa vazia do array valp (grade P)
                    valm.splice(i, 1); //apaga a casa vazia do array valp (grade M)
                    valg.splice(i, 1); //apaga a casa vazia do array valp (grade G)
                    numpassado.splice(i*3,1); //apaga a casa vazia do array numpassado (numero de peças)
                    break; //força a saida do for
                }
                else { //se as casas n estiverem vazias
                    for (j = 0; j < numpassado.length; j++) { //for para rodar o array do numero de peças que ja entraram
                        if (numpassado[j][0] == valp[i][0] && numpassado[j][1] != valp[i][1]) { //confere se o nome da posiçao nos arrays é igual mas o valor diferente (valp)
                            numpeca -= numpassado[j][1]; //tira o valor antigo da soma
                            numpeca += valp[i][1]; //adiciona o novo valor na soma
                            numpassado[j][1] = valp[i][1]; //troca o antigo valor pelo novo no array de valores passados
                        }
                        else if (numpassado[j][0] == valm[i][0] && numpassado[j][1] != valm[i][1]) { //confere se o nome da posiçao nos arrays é igual mas o valor diferente (valm)
                            numpeca -= numpassado[j][1]; //tira o valor antigo da soma
                            numpeca += valm[i][1]; //adiciona o novo valor na soma
                            numpassado[j][1] = valm[i][1]; //troca o antigo valor pelo novo no array de valores passados
                        }
                        else if (numpassado[j][0] == valg[i][0] && numpassado[j][1] != valg[i][1]) { //confere se o nome da posiçao nos arrays é igual mas o valor diferente (valg)
                            numpeca -= numpassado[j][1]; //tira o valor antigo da soma
                            numpeca += valg[i][1]; //adiciona o novo valor na soma
                            numpassado[j][1] = valg[i][1]; //troca o antigo valor pelo novo no array de valores passados
                        }
                        else if (numpassado[j][0] == null && numpassado[j][1] == null) { //confere se o nome e o valor sao nuloes
                            numpassado.splice(j,1); //apaga a posiçao nula
                            numpeca += valp[i][1]; //soma o valor da grade P
                            numpassado.push([valp[i][0], valp[i][1]]); //adiciona no array de valores passados(numpassado) o nome e o valor da grad P
                            numpeca += valm[i][1]; //soma o valor da grade M
                            numpassado.push([valm[i][0], valm[i][1]]); //adiciona no array de valores passados(numpassado) o nome e o valor da grad M
                            numpeca += valg[i][1]; //soma o valor da grade G
                            numpassado.push([valg[i][0], valg[i][1]]); //adiciona no array de valores passados(numpassado) o nome e o valor da grad G
                            numpassado.push([]); //cria uma nova posiçao nula para que o processo se repita
                            break; //força a saida do for
                        }
                    } //fim do for que roda o array de valores passados
                } //fim do else
            } //fim do for que roda o array de grade P/M/G

            for (i = 0; i < valmat.length; i++) { //for para rodar o valor dos materias no array valmat
                if(valmat[i][0] == null && valmat[i][1] == null){ //confere se a posiçao do array(valmat) é nula
                    valmat.splice(i,1); //apaga a posiçao
                }
                else if (matpassado[i][0] == valmat[i][0] && matpassado[i][1] != valmat[i][1]) { //confere se o nome é igual mas o valor diferente
                    precomat -= matpassado[i][1] * matpassado[i][2]; //tira o valor antigo da soma
                    precomat += valmat[i][1] * valmat[i][2]; //adiciona o valor novo
                    matpassado[i][1] = valmat[i][1]; //troca o valor antigo pelo novo no array de materiais passados(mastpassado)
                }
                else if (matpassado[i][0] == null && matpassado[i][1] == null) { //confere se a possiçao do array(matpassado) é nula
                    precomat += valmat[i][1] * valmat[i][2]; //adiciona o valor na soma
                    matpassado[i][0] = valmat[i][0]; //adiciona o nome do material no array matpassado
                    matpassado[i][1] = valmat[i][1]; //adiciona o valor do material no array matpassado
                    matpassado[i][2] = valmat[i][2]; //adiciona a quantidade do material no array matpassado
                    matpassado.push([]); //cria uma nova posiçao nula para que processo se repita
                }
            }

        vtecido = parseFloat(document.getElementById("vtecido").value, 100); //pega o valor do tecido
        vforro =  parseFloat(document.getElementById("vforro").value, 100); //pega o valor do forro
        ventretela =  parseFloat(document.getElementById("ventretela").value, 100); //pega o valor da entretela

        vpeca = (vtecido * rendimento) + (ventretela * entretela) + (vforro * forro) + precomat + corte + costura; //faz a soma do valor da peça
        totalpeca = vpeca * numpeca; //valor total da peças (valor da peça X numero de peças na grade)
        totalmat = precomat * numpeca; //valor do total do material (valor do material X numero de peças na grade)
        estimado = (vpeca / 0.36750).toFixed(2);
        document.getElementById('resultado').innerHTML = '<label>Valor por peça: ' + vpeca.toFixed(2) + ' </label>' +//mostra na tela os valores
            '<label> | Valor estimado de venda: '+estimado +'</label></br>' +
            '<label> Valor total das peças: ' + totalpeca.toFixed(2) + ' </label>' +
            '<label> | Valor total dos materiais: ' + totalmat.toFixed(2) + ' </label>';
        document.getElementById('valorpeca').value = vpeca.toFixed(2);
        document.getElementById('quantpeca').value = numpeca;
    }
    else { //se algum dos valores necessarios nao tiver sido inserido
            document.getElementById('resultado').innerHTML = '<label>Faltam valores a serem inseridos</label>'; //mostra que faltam valores a serem inseridos
        }
}