#include <stdio.h>
    int main() {

        int numero = 5;
        int resultado;

        resultado = numero % 2;

        printf("A variável resultado é: %d\n", resultado);

        if(resultado == 0) {
            printf("\nO número %d é PAR\n", numero);
        } else {
            printf("\nO número %d é ÍMPAR\n", numero);
        }


 }       