**Versão do PHP:** 8.4.5(cli)

* Framework utilizado: **Breeze**
  : > https://laravel.com/docs/9.x/starter-kits#breeze
---
 
**Instruções para rodar o projeto laravel:**

* 1 - Configure o **.env** ⚙️ com as informações de conexão ao banco de dados

---

* 2 - Instalar as dependências: 
**instlar o breeze, dar um require nele, instalar as dependencias com o node e rodar o composer install**


---

* 3 - Rode as migrations: **php artisan migrate / e verifique se as tabelas foram criadas no banco de dados** 

* Obs: **verifique se está conectado ao banco de dados** ✔

   : > talvez precise fazer alguam configuração em **/config.php/database.php**
   : > não se esqueca de criar as sessions para a migrate(**php artisan session:table**)
   : > e depois rodar o comando php artisan migrate. Caso já haja tabelas criadas, rode o comando php artisan migrate:fresh. Ou se preferir utilize um rolllback, sua escolha.
   : > *se não conseguir se conctar ao banco devido a algum erro, tente habilitar a extenção do mysql no **php.ini**
   
    


---

* 4 - Rode as seeds: **php artisan db:seed / caso precise rodar a seed posts também rode**

---

* 5 - Carregue as imagens: **php artisan storage:link**

---

* 6 -💻 Rode o servidor: **php artisan serve**  

* 7 - neste commit a aplicação está utilizando **REACT + INERTIA**, então não se esqueça de:
* 
  {
* *baixar as dependências*;
* *Conferir que está utilizando o kit starter do breeze*;
* *rodar o npm run dev junto do artisan serve*;
* *verificar se o controller está retornando para a view ou o inertia::render()*;
* *verificar as rotas se contém os middwmiddlewares certos que o inertia adicionou ao ;projeto, como o logout e o dashboard*;
  }


;=================================;
  ****


📩
* Foi feito a implementação de email utilizando o **mailtrap** para testes, configure o .env caso queira utilizar. E não se esqueça de rodar a migrate:queue-table e failed-table

* E também de rodar o woker!!

**Funcionalidade: enviar mensagem de um coméntario para o dono do post**

---
**Websocket integrado com sucesso! Não qualquer coisa siga esta documentação: https://laravel.com/docs/12.x/broadcasting#using-example-application**
*Porém, ao baixar as dependências, é para funcionar corretamente. E é importante limpar o cache com o optimze:clear*

