#include           <stdio.h>



int main() {

    int idade;

    float renda;

    printf("Digite sua idade: ");    

    scanf("%d", &idade);

    printf("Digite sua renda mensal: ");

    scanf("%f", &renda);


    if (idade <= 18 || idade >= 60)

    {

        if (renda < 2000)

        {

            printf("Você tem direito ao benefício de isenção de imposto de renda.\n");

        } else {

            printf("Você não atende aos critérios de isenção devido à sua renda.\n");

        }

    } else {

        printf("Você não atende aos critérios de isenção devido à sua idade.\n");

    }

    return 0;

}