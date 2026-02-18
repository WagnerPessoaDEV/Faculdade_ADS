#include <stdio.h>

int main() {
   int variavel;

   printf("Digite um valor\n");
    scanf("%d", &variavel);
   
   switch (variavel) {
    case 1:
        printf("Código a ser executado se variavel == 1\n");
        // código a ser executado se variavel == valor1
    break;
    case 2:
        printf("Código a ser executado se variavel == 2\n");
        // código a ser executado se variavel == valor2  
    break;
    default:
        printf("Código a ser executado se variavel não for 1 nem 2\n");
        // código a ser executado se nenhum dos casos forem verdadeiro  
   }



    return 0;
}