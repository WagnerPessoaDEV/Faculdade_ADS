#include <stdio.h>

int main() {
   int idade = 17;

   if (idade >= 18) {
       printf("Você é maior de idade e pode proceseguir com o acesso!\n");
   } else {
       printf("Infelizmente, você é menor de idade e não pode acessar o conteúdo!\n");
   }

   return 0; // Boa prática retornar 0 em main
}