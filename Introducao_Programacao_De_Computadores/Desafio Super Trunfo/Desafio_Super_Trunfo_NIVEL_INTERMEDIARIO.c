#include <stdio.h>

int main() {
    //Carta 1: Brasil
    char pais1[20] = "Brasil";
    int populacao1 = 214;
    float area1 = 8.5;
    float pib1 = 1.6;
    int pontos1 = 50;
    float densidade1 = 25.1;
    //Carta 2: Argentina
    char pais2[20] = "Argentina";
    int populacao2 = 45;
    float area2 = 2.7;
    float pib2 = 0.4;
    int pontos2 = 35;
    float densidade2 = 16.4;

    int opcao;

    printf("### SUPER TRUNFO ###\n");
    printf("Escolha um atributo:\n");
    printf("1 - Populacao\n");
    printf("2 - Area\n");
    printf("3 - PIB\n");
    printf("4 - Pontos Turisticos\n");
    printf("5 - Densidade Demografica\n");
    printf("Digite o numero da opcao: ");
    scanf("%d", &opcao);

    printf(" ### RESULTADO DA COMPARACAO ###\n");

    
    switch (opcao) {
        case 1:
            printf("Atributo: Populacao\n");
            printf("%s: %d vs %s: %d\n", pais1, populacao1, pais2, populacao2);
            if (populacao1 > populacao2) {
                printf("Vencedor: %s\n", pais1);
            } else if (populacao2 > populacao1) {
                printf("Vencedor: %s\n", pais2);
            } else {
                printf("Empate!\n");
            }
            break;
        
        case 2:
            printf("Atributo: Area\n");
            printf("%s: %.2f vs %s: %.2f\n", pais1, area1, pais2, area2);
            if (area1 > area2) {
                printf("Vencedor: %s\n", pais1);
            } else if (area2 > area1) {
                printf("Vencedor: %s\n", pais2);
            } else {
                printf("Empate!\n");
            }
            break;

        case 3:
            printf("Atributo: PIB\n");
            printf("%s: %.2f vs %s: %.2f\n", pais1, pib1, pais2, pib2);
            if (pib1 > pib2) {
                printf("Vencedor: %s\n", pais1);
            } else if (pib2 > pib1) {
                printf("Vencedor: %s\n", pais2);
            } else {
                printf("Empate!\n");
            }
            break;

        case 4:
            printf("Atributo: Pontos Turisticos\n");
            printf("%s: %d vs %s: %d\n", pais1, pontos1, pais2, pontos2);
            if (pontos1 > pontos2) {
                printf("Vencedor: %s\n", pais1);
            } else if (pontos2 > pontos1) {
                printf("Vencedor: %s\n", pais2);
            } else {
                printf("Empate!\n");
            }
            break;

         case 5:
            printf("Atributo: Densidade Demografica\n");
            printf("%s: %.2f vs %s: %.2f\n", pais1, densidade1, pais2, densidade2);
            // REGRA ESPECIAL: Na densidade, o MENOR valor vence!
            if (densidade1 < densidade2) {
                printf("Vencedor: %s\n", pais1);
            } else if (densidade2 < densidade1) {
                printf("Vencedor: %s\n", pais2);
            } else {
                printf("Empate!\n");
            }
            break;

        default:
            printf("Essa opçao nao existe no menu.\n");
            break;
    }

    return 0;
}