#include <stdio.h>

int main() {
    // ===== CARTA 1 =====
    char estado1[10];
    char codigo1[4];
    char cidade1[50];
    int populacao1;
    float area1;
    float pib1;
    int pontos1;

    // ===== CARTA 2 =====
    char estado2[10];
    char codigo2[4];
    char cidade2[50];
    int populacao2;
    float area2;
    float pib2;
    int pontos2;

    // ===== ENTRADA DE DADOS - CARTA 1 =====
    printf("Cadastro da Carta 1\n");

    printf("Estado:\n");
    scanf(" %c", &estado1);

    printf("Codigo da Carta (ex: A01):\n");
    scanf("%s", codigo1);

    printf("Nome da Cidade:\n");
    scanf(" %[^\n]", cidade1);

    printf("Populacao:\n");
    scanf("%d", &populacao1);

    printf("Area (km²):\n");
    scanf("%f", &area1);

    printf("PIB (em Bilhoes de reais):\n");
    scanf("%f", &pib1);

    printf("Numero de Pontos Turisticos:\n");
    scanf("%d", &pontos1);

    // ===== ENTRADA DE DADOS - CARTA 2 =====
    printf("Cadastro da Carta 2\n");

    printf("Estado (A a H):\n");
    scanf(" %c", &estado2);

    printf("Codigo da Carta (ex: B02):\n");
    scanf("%s", codigo2);

    printf("Nome da Cidade:\n");
    scanf(" %[^\n]", cidade2);

    printf("Populacao:\n");
    scanf("%d", &populacao2);

    printf("Area (km²):\n");
    scanf("%f", &area2);

    printf("PIB (em Bilhoes de reais):\n");
    scanf("%f", &pib2);

    printf("Numero de Pontos Turisticos:");
    scanf("%d", &pontos2);

    // ===== SAÍDA DE DADOS =====
    printf("\n===== CARTA 1 =====\n");
    printf("Estado: %c\n", estado1);
    printf("Codigo: %s\n", codigo1);
    printf("Nome da Cidade: %s\n", cidade1);
    printf("Populacao: %d\n", populacao1);
    printf("Area: %.2f km²\n", area1);
    printf("PIB: %.2f Bilhoes de reais\n", pib1);
    printf("Numero de Pontos Turisticos: %d\n", pontos1);

    printf("\n===== CARTA 2 =====\n");
    printf("Estado: %c\n", estado2);
    printf("Codigo: %s\n", codigo2);
    printf("Nome da Cidade: %s\n", cidade2);
    printf("Populacao: %d\n", populacao2);
    printf("Area: %.2f km²\n", area2);
    printf("PIB: %.2f Bilhoes de reais\n", pib2);
    printf("Numero de Pontos Turisticos: %d\n", pontos2);

    return 0;
}