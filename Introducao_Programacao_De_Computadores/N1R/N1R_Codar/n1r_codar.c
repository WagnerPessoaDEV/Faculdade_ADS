#include <stdio.h>

int main() {
    float temperatura, umidade;
    unsigned int estoque; unsigned int estoqueMinimo = 1000;

    printf("Digite a temperatura atual:\n");
    scanf("%f", &temperatura);
    printf("Digite a umidade atual:\n");
    scanf("%f", &umidade);
    printf("Digete o estoque atual:\n");
    scanf("%u", &estoque);

    if( temperatura > 30) {
        printf("Temperatura está alta!\n");
    } else {
        printf("Temperatura dentro dos parâmetros.\n");
    }

    if ( umidade > 50 ) {
        printf("Umidade está ELEVADA!\n");
    } else {
        printf("Umidade dentro dos parâmetros.\n");

    }

    if ( estoque < estoqueMinimo) {
        printf("Estoque está BAIXO!\n");
    } else {
        printf("Estoque dentro dos parâmetros.\n");
    }
}