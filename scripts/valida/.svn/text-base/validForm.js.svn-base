// Funções de Validação para os Formulários de Impressão.
/* GLOBAL */

//Função que muda o foco de um campo para outro, independente da quantidade de "forms" !
function saltaCampoForms(ev, atualCampo, tp_atual, maxCaract, acceptButton)
{		
	var formPesq=atualCampo.form, indFormPesq=-1, indCampoPesq=-1, max=maxCaract, proximoCampo=null,
		search=(acceptButton)?(/^(text|password|select.*|radio|checkbox.*|button|textarea)$/)
							 :(/^(text|password|select.*|radio|checkbox.*|textarea)$/);
	
	var tc = brow().isNetscape()?ev.which:ev.keyCode;
	
	//Função interna para "setar" o foco...
	setFocus = function()
	{ 
		if ( (/^(neg_)?money/.test(tp_atual)) 
			&&
			 (verifyMaxValue(atualCampo.value)) )
				atualCampo.value="0,00";

		else if(/^(date|month_year|time|cpf|cnpj|cpf_cnpj|cep|account|branch|percent|ag_account|ag_savings)$/.test(tp_atual))
			max=eval("SZ_"+tp_atual.toUpperCase());

		if (String(atualCampo.value).length>=max)
		{
			proximoCampo.focus();
			return true;
		}
		else return false;
	};


	var posicionamentoElem = new Posicao_FormCampo(formPesq, atualCampo);
	
	indFormPesq  = posicionamentoElem.FormPesq;
	indCampoPesq = posicionamentoElem.CampoPesq;

	//Obtendo o próximo campo que receberá o foco...
	for (var i=indFormPesq; i<=document.forms.length-1; i++) //Varrendo os formulários atual e posteriores...
	{
		formPesq = document.forms[i]; //Formulário que está sendo pesquisado...
	
		//Caso não seja o formulário atual recebe zero, sendo... receberá o índice do atual + 1 !!!
		if (i==indFormPesq)			
			 indCampoPesq += 1;
		else indCampoPesq  = 0;
		
		for (var j=indCampoPesq; j<=formPesq.elements.length-1; j++) //Verificando o próximo campo válido do formulário selecionado!
		{
			proximoCampo = formPesq.elements[j];

			if ((tc >= 48) && search.test(proximoCampo.type) && !proximoCampo.disabled && (proximoCampo.tabIndex!=-1)) //Caso o campo seja válido !!!
				return ( setFocus() );
		}
	}//for externo...
}//saltaCampoForms


//{ CLASSE! }
/**
 * Retorna a posição dos respectivos formulários e campos informados
 ********************************************************************/
function Posicao_FormCampo (_formPesq, _atualCampo) 
{
	//Obtendo o índice do formulário atual!!!
	for (var i=0; i<=document.forms.length-1; i++)
	{
		if (document.forms[i]==_formPesq)
		{
			this.FormPesq = i;

			//Obtendo a posição do campo atual...
			for (var j=0; j<=_formPesq.elements.length-1; j++)
			{
				if (_formPesq.elements[j]==_atualCampo)
				{
					this.CampoPesq = j; //Quando for iniciar a pesquisa, pegar o índice posterior a esse...
					break;
				}
			}
		}
	}//for externo...

}//Posicao_FormCampo


/* SECÇÃO ABERTURA DE CONTA */
function sessaoDadosEmpresa() {
	var nomes=["nomeEmp","cnpjEmp","ramoAtivEmp","numFuncEmp","primPartCEP_Emp","segPartCEP_Emp","ufEmp","cidadeEmp","ruaEmp","numEnderecoEmp","compEndEmp","bairroEmp"];
	var headers=["Nome da Empresa","CNPJ","Ramo de atividade","N.º de funcionários","CEP - 1º Campo","CEP - 2º Campo","Estado","Cidade","Rua","N.º","Complemento","Bairro"];
	
	if(checkCamposObrig(document.formDadosEmpresa,nomes,headers)) return true;
	return false;
}//sessaoDadosEmpresa

function sessaoDadosContato() {
	var nomes=["nomeCont","cargoCont","primPartTel_Cont","segPartTel_Cont","emailCont"];
	var headers=["Nome para contato","Cargo","DDD","Telefone","E-mail"];
	
	if(checkCamposObrig(document.formDadosContato,nomes,headers)) return true;
	return false;
}//sessaoDadosContato

function sessaoDadoAgencia() {
	var nomes=["numAgencia"];
	var headers=["Número da Agência"];

	if(checkCamposObrig(document.formDadoAgencia,nomes,headers)) 
		 return true;
	else return false;
}//sessaoDadoAgencia

function formSubmit()
{
	if ( sessaoDadosEmpresa() &&
		 sessaoDadosContato() && 
		 sessaoDadoAgencia() )

		alert("Todos os campos foram preenchidos!!!");
}//formSubmit