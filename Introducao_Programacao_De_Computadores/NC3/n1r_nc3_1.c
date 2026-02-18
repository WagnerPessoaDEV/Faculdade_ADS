#include <stdio.h>

int main() {
   int numero1;
   int numero2;

    numero1 = 10;
    numero2 = 5;
   
   if (numero1 > numero2) {
      printf("Numero 1 é maior que Numero 2\n");
   
    } else if (numero1 < numero2) {
      printf("Numero 1 é menor que Numero 2\n");
   
    } else if (numero1 == numero2) {
      printf("Numero 1 é igual a Numero 2\n");
   }
}