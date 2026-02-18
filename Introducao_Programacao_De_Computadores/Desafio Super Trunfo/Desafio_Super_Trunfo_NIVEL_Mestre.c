#include <stdio.h>
#include <string.h>
#include <stdlib.h>
#include <time.h>

int main () {
    int resultado1, resultado2;
    char primeiroAtributo, segundoAtributo;
    int ataque1, ataque2, defesa1, defesa2, recuo1, recuo2;

    srand(time(0));
    ataque1 = 1 + rand() % 100 + 1;
    ataque2 = 0 + rand() % 100 + 1;
    defesa1 = 1 + rand() % 100 + 1;
    defesa2 = 0 + rand() % 100 +1;
    recuo1 = 0 + rand() % 100 + 1;
    recuo2 = 1 + rand() % 100 +1;

    printf("### BEM - VINDO AO JOGO SUPER TRUNFO ###\n");
    printf("Escolha um atributo para comparar:\n");
    printf("A - Ataque\n");
    printf("B - Defesa\n");
    printf("C - Recuo\n");

    printf("Escolha comparação:\n");
    scanf(" %c", &primeiroAtributo);

    switch (primeiroAtributo){
        case 'A':
        case 'a':
            printf("Atributo escolhido: Ataque\n");
            resultado1 = ataque1 > ataque2;
            resultado2 = ataque2 > ataque1;
            printf("Carta 1 - Ataque: %d\n", ataque1);
            printf("Carta 2 - Ataque: %d\n", ataque2);
            if (resultado1) {
                printf("Vencedor: Carta 1\n");
            } else if (resultado2) {
                printf("Vencedor: Carta 2\n");
            } else {
                printf("Empate!\n");
            }
            break;

        case 'B':
        case 'b':
            printf("Atributo escolhido: Defesa\n");
            printf("Carta 1 - Defesa: %d\n", defesa1);
            printf("Carta 2 - Defesa: %d\n", defesa2);
            if (defesa1 > defesa2) {
                printf("Vencedor: Carta 1\n");
            } else if (defesa2 > defesa1) {
                printf("Vencedor: Carta 2\n");
            } else {
                printf("Empate!\n");
            }
            break;
        case 'C':
        case 'c':
            printf("Atributo escolhido: Recuo\n");
            printf("Carta 1 - Recuo: %d\n", recuo1);
            printf("Carta 2 - Recuo: %d\n", recuo2);
            if (recuo1 > recuo2) {
                printf("Vencedor: Carta 1\n");
            } else if (recuo2 > recuo1) {
                printf("Vencedor: Carta 2\n");
            } else {
                printf("Empate!\n");
            }
            break;
    
    default:
        break;
    }



   
    






}