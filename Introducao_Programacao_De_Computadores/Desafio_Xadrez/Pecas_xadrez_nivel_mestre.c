#include <stdio.h>

/*
 DESAFIO NÍVEL MESTRE - XADREZ
 - Torre: Recursividade
 - Bispo: Recursividade + loops aninhados
 - Rainha: Recursividade
 - Cavalo: Loops aninhados complexos
*/

/*
FUNÇÃO RECURSIVA - TORRE
Movimento: para cima (vertical)
*/
void moverTorre(int casas)
{
//caso base: quando não há mais casas para andar
    if (casas == 0)
        return;

    printf("Cima\n");
//chamada recursiva diminuindo 1 casa
    moverTorre(casas - 1);
}
/*
FUNÇÃO RECURSIVA - RAINHA
Movimento: diagonal (cima + direita)
*/
void moverRainha(int casas)
{
    if (casas == 0)
        return;

    printf("Cima\n");
    printf("Direita\n");

    moverRainha(casas - 1);
}
/*
FUNÇÃO RECURSIVA - BISPO
Requisito:
- Recursividade
- Loops aninhados
- Loop externo = vertical
- Loop interno = horizontal
*/
void moverBispo(int casas)
{
    if (casas == 0)
        return;
//loop externo - movimento vertical
    for (int v = 1; v <= 1; v++)
    {
        printf("Cima\n");
//loop interno - movimento horizontal
        for (int h = 1; h <= 1; h++)
        {
            printf("Direita\n");
        }
    }
//chamada recursiva
    moverBispo(casas - 1);
}
/*
CAVALO - LOOPS ANINHADOS COMPLEXOS
Movimento em "L":
- 2 casas para cima
- 1 casa para a direita
Uso de break e continue
*/
void moverCavalo()
{
    int movimentosVerticais = 2;
    int movimentosHorizontais = 1;
//loop externo controla as duas casas para cima
    for (int v = 1; v <= movimentosVerticais; v++)
    {
        printf("Cima\n");
//se ainda não chegou na última subida, continua
        if (v < movimentosVerticais)
            continue;
//loop interno executa somente após as duas casas para cima
        for (int h = 1; h <= movimentosHorizontais; h++)
        {
            printf("Direita\n");
            break;
        }
    }
}
//FUNÇÃO PRINCIPAL
int main()
{
//quantidade de casas
    int casasTorre = 5;
    int casasBispo = 4;
    int casasRainha = 3;

    printf("Movimento da Torre:\n");
    moverTorre(casasTorre);

    printf("\n");

    printf("Movimento do Bispo:\n");
    moverBispo(casasBispo);

    printf("\n");

    printf("Movimento da Rainha:\n");
    moverRainha(casasRainha);

    printf("\n");

    printf("Movimento do Cavalo:\n");
    moverCavalo();

    return 0;
}
