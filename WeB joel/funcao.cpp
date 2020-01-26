#include "/usr/local/mysql-S4/include/mysql.h"
#include <iostream>
#include <string>
using namespace std;
// BD_usuarios / name / usuario / senha 
void conectarSQL(){

  MYSQL connection;
  mysql_init(&connection);
  if(mysql_real_connect(&connection, "localhost", "root", "mys4rootm", "BD_usuarios", 0, NULL, 0)){
    cout<<"Conexão realizada!"<<endl; 
    mysql_close(&connection);
  } else cerr<<"Conexão falhou!"<<endl;
  
}

void realizarLogin2 (string username, string userpass){
  
  conectarSQL();
  cout<<"Conexão realizada!"<<endl; 
  string query = "SELECT userpass FROM tb_logins WHERE username='"+username+"'";
  mysql_query(&connection, query.c_str());

  MYSQL_RES *res = mysql_store_result(&connection);
  MYSQL_ROW row = mysql_fetch_row(res);

  if(row[0]==userpass) cout<<"Logado com sucesso!"<<endl;
  else cerr<<"Erro de login!"<<endl;
  mysql_close(&connection);
  
}
/*

void realizarLogin (string username, string userpass){
  MYSQL connection;
  mysql_init(&connection);
  if(mysql_real_connect(&connection, "localhost", "root", "mys4rootm", "teste", 0, NULL, 0)){

    cout<<"Conexão realizada!"<<endl; 
    string query = "SELECT userpass FROM tb_logins WHERE username='"+username+"'";
    mysql_query(&connection, query.c_str());

    MYSQL_RES *res = mysql_store_result(&connection);
    MYSQL_ROW row = mysql_fetch_row(res);

    if(row[0]==userpass) cout<<"Logado com sucesso!"<<endl;
    else cerr<<"Erro de login!"<<endl;
    mysql_close(&connection);

  } else cerr<<"Conexão falhou!"<<endl;
}

void cadastrar (string username, string userpass, string name){

  MYSQL connection;
  mysql_init(&connection);

  if(mysql_real_connect(&connection, "localhost", "root", "mys4rootm", "teste", 0, NULL, 0)){
    
    string query = "INSERT INTO tb_logins (name, username, userpass) VALUES ('"+name+"', '"+username+"', '"+userpass+"')";

    if(mysql_query(&connection, query.c_str())) cerr<<"Cadastrado Falhou!"<<endl;
    else cout<<"Cadastrado com sucesso!"<<endl;

    mysql_close(&connection);

  } else cerr<<"Conexão falhou."<<endl;
}

void listar (){
 
  MYSQL connection;
  mysql_init(&connection);

  if(mysql_real_connect(&connection, "localhost", "root", "mys4rootm", "teste", 0, NULL, 0)){
    
    string query = "SELECT * FROM tb_logins";

    if(mysql_query(&connection, query.c_str())) cerr<<"Listagem falhou!"<<endl;
    else{

      MYSQL_RES *res = mysql_store_result(&connection);
      int num_fields = mysql_num_fields(res);
      MYSQL_ROW row;
      while(row=mysql_fetch_row(res)){

        for(int i=0; i<num_fields; i++){
          cout<<row[i]<<"  ||ACABOU||  ";
        }

        cout<<endl;
      }
    }

    mysql_close(&connection);
  } else cerr<<"Conexão falhou."<<endl;
}

void editarTudo (string username, string usernameNew, string userpass, string name){

  MYSQL connection;
  mysql_init(&connection);

  if(mysql_real_connect(&connection, "localhost", "root", "mys4rootm", "teste", 0, NULL, 0)){
    
    string query = "UPDATE tb_logins SET name =//BD_usuarios '"+name+"', username = '"+usernameNew+"', userpass = '"+userpass+"' WHERE username='"+username+"'";

    if(mysql_query(&connection, query.c_str())) cerr<<"Modificação de tudo falhou!"<<endl;
    else cout<<"Modificação de tudo realizada com sucesso!"<<endl;

    mysql_close(&connection);
  } else cerr<<"Conexão falhou."<<endl;
}

void editarUsername (string username, string usernameNew){

  MYSQL connection;
  mysql_init(&connection);

  if(mysql_real_connect(&connection, "localhost", "root", "mys4rootm", "teste", 0, NULL, 0)){
    
    string query = "UPDATE tb_logins SET username = '"+usernameNew+"' WHERE username='"+username+"'";

    if(mysql_query(&connection, query.c_str())) cerr<<"Modificação de Username falhou!"<<endl;
    else cout<<"Username modificado com sucesso!"<<endl;

    mysql_close(&connection);
  } else cerr<<"Conexão falhou."<<endl;
}

void editarUserpass (string username, string userpass){

  MYSQL connection;
  mysql_init(&connection);

  if(mysql_real_connect(&connection, "localhost", "root", "mys4rootm", "teste", 0, NULL, 0)){
    
    string query = "UPDATE tb_logins SET userpass = '"+userpass+"' WHERE username='"+username+"'";

    if(mysql_query(&connection, query.c_str())) cerr<<"Modificação de Userpass falhou!"<<endl;
    else cout<<"Userpass modificado com sucesso!"<<endl;

    mysql_close(&connection);//BD_usuarios
  } else cerr<<"Conexão falhou."<<endl;
}

void editarNome (string username, string name){

  MYSQL connection;
  mysql_init(&connection);

  if(mysql_real_connect(&connection, "localhost", "root", "mys4rootm", "teste", 0, NULL, 0)){
    
    string query = "UPDATE tb_logins SET name = '"+name+"' WHERE username='"+username+"'";

    if(mysql_query(&connection, query.c_str())) cerr<<"Modificação de nome falhou!"<<endl;
    else cout<<"Nome modificado com sucesso!"<<endl;

    mysql_close(&connection);
  } else cerr<<"Conexão falhou."<<endl;
}

*/
int main(int argc, char *argv[]) {

  return 0;
}