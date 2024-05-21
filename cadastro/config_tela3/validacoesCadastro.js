


function validarNome(){
  let nome = document.getElementById('nome').value;
  if(nome.length < 15 ){
    exibirToast("Nome inválido. O Nome deve ter pelo menos 15 Letras.",true)
  }
  else if(nome.length >80){
    exibirToast("Nome inválido. O Nome deve ter no máximo 80 letras",true)
  }
  else{
    exibirToast("Nome válido",false)
  }
}
const converterParaMaiusculo = (valor) => valor.toUpperCase();

function validarMae() {
  let mae = document.getElementById('mae').value.trim();
  mae = converterParaMaiusculo(mae);
  
  

  if (mae.length < 15 || mae.length > 80) {
    exibirToast("Caso nada seja declarado, o nome da sua mãe será como NÃO DECLARADO", true);
  } else {
    exibirToast("Nome válido", false);
  }
}
function validarSenha() {
  let senha = document.getElementById('senha').value;
  let confirmaSenha = document.getElementById('confirma').value;

  let regex = /^[A-Za-z]{8}$/;

  if (regex.test(senha)) {
      if (senha === confirmaSenha) {
          exibirToast('Senhas válidas!', false);
      } else {
          exibirToast('As senhas não coincidem.', true);
      }
  } else {
      exibirToast('Senha inválida. Certifique-se de que são 8 caracteres alfabéticos.', true);
  }
}
function validarUsuario(){
  let usuario = document.getElementById('login').value;

  let regex = /^[A-Za-z]{6}$/;

  if (regex.test(usuario)) {
    exibirToast("Usuário válido",false);
  }else{
    exibirToast("Usuário inválido. Devem ser 6 letras",true); 
  }
}

function validarIdade() {
  let anoAtual = new Date();
  let dataNascimento = new Date(document.getElementById('nasc').value);

  let idade = anoAtual.getFullYear() - dataNascimento.getFullYear();

  if (anoAtual.getMonth() < dataNascimento.getMonth() || (anoAtual.getMonth() === dataNascimento.getMonth() && anoAtual.getDate() < dataNascimento.getDate())) {
      idade--;
  }

  if (idade >= 18 && idade <= 100) {
      exibirToast("Idade válida.", false);
  } else {
      exibirToast("Idade inválida.", true);
      document.getElementById('nasc').value = '';
  }
}

function exibirToast(mensagem, erro) {
  let toast = document.getElementById('toast');
  toast.innerHTML = mensagem;

  erro ? toast.classList.add('erro') : toast.classList.remove('erro');

  toast.style.display = 'block';

  setTimeout(function () {
      toast.style.display = 'none';
  }, 3000);
}

function ajustaCpf(v) {
  v.value = v.value.replace(/\D/g, "");
  v.value = v.value.replace(/^(\d{3})(\d)/, "$1.$2");
  v.value = v.value.replace(/(\d{3})(\d)/, "$1.$2");
  v.value = v.value.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
}

function validarCPF() {
  const cpfInput = $("#cpf");
  const cpf = cpfInput.val().replace(/\D/g, ''); // Remover caracteres não numéricos

  if (verificarCPF(cpf)) {
      exibirToast('CPF válido');
  } else {
      exibirToast('CPF inválido', true);
  }
}

function verificarCPF(cpf) {
  if (cpf.length !== 11 || /^(.)\1+$/.test(cpf)) {
      return false;
  }

  let add = 0;
  let rev;

  for (let i = 0; i < 9; i++) {
      add += parseInt(cpf.charAt(i)) * (10 - i);
  }
  rev = 11 - (add % 11);
  rev = rev >= 10 ? 0 : rev;
  if (rev !== parseInt(cpf.charAt(9))) {
      return false;
  }

  add = 0;
  for (let i = 0; i < 10; i++) {
      add += parseInt(cpf.charAt(i)) * (11 - i);
  }
  rev = 11 - (add % 11);
  rev = rev >= 10 ? 0 : rev;
  if (rev !== parseInt(cpf.charAt(10))) {
      return false;
  }

  return true;
}

function ajustaCelular(v) {
  v.value = v.value.replace(/\D/g, ""); // remove todos os caracteres que não são dígitos
  // Insere o sinal de mais e o parênteses no código do país
  v.value = v.value.replace(/^(\d{2})(\d)/g, "(+$1) $2");
  // Insere o hífen depois do DDD e depois dos primeiros 5 dígitos do número
  v.value = v.value.replace(/(\d{2})(\d{5})(\d{4})/, "$1-$2-$3");
}
function validaCelular() {
  let celular = document.getElementById('Celular').value;

  // Expressão regular para validar o formato do número de telefone
  let regexTelefone = /^\(\+55\) \d{2}-\d{5}-\d{4}$/;

  // Verifica se o número de telefone corresponde ao formato esperado
  if (regexTelefone.test(celular)) {
      exibirToast('Número de telefone válido!');
  } else {
      exibirToast('Por favor, insira um número de celular válido no formato (+55) xx-xxxxx-xxxx.', true);
  }
}

function ajustaTelefone(v) {
  v.value = v.value.replace(/\D/g, ""); // remove todos os caracteres que não são dígitos
  // Insere o sinal de mais e os parênteses no código do país
  v.value = v.value.replace(/^(\d{2})(\d)/g, "(+$1) $2");
  // Insere o hífen depois do DDD e depois dos primeiros 5 dígitos do número
  v.value = v.value.replace(/(\d{2})(\d{4})(\d{4})/, "$1-$2-$3");
}


function validaTelefone() {
  let telefone = document.getElementById('telefone').value;

  // Expressão regular para validar o formato do número de telefone
  let regexTelefone = /^\(\+55\) \d{2}-\d{4}-\d{4}$/;

  // Verifica se o número de telefone corresponde ao formato esperado
  if (regexTelefone.test(telefone)) {
      exibirToast('Número de telefone válido!');
  } else {
      exibirToast('Por favor, insira um número de telefone válido no formato (+55) xx-xxxx-xxxx.', true);
  }
}




let cep = document.getElementById('cep');
let endereco = document.getElementById('endereco');
let bairro = document.getElementById('bairro');
let estado = document.getElementById('estado');

cep.addEventListener("blur", () => {
  let valorCep = cep.value;
  let url = "https://viacep.com.br/ws/" + valorCep + "/json/";

  axios.get(url)
    .then(response => {
      let data = response.data;
      if (data.erro) {
        // CEP não encontrado, exibe uma mensagem de erro
        document.getElementById('mensagemErro').textContent = "CEP não encontrado";
      } else {
        // Preenche os campos com os dados do CEP
        endereco.value = data.logradouro;
        bairro.value = data.bairro;
        estado.value = data.uf;
        // Limpa a mensagem de erro
        document.getElementById('mensagemErro').textContent = "";
      }
    })
    .catch(error => {
      // Trate qualquer erro que ocorra
      console.error("Erro na requisição: " + error);
    });
});
