#include <stdio.h>

int main() {
   int nota = 55;

   if (nota >= 60) {
       printf("Parabéns, você foi APROVADO!!\n");
   } else {
       printf("Infelizmente, você foi REPROVADO!!\n");
   }

   return 0; // Boa prática retornar 0 em main
}