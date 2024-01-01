function inserirConteudoNaDiv(div) {
    // Cria a div que irá conter os elementos
    const minhaDiv = document.createElement("div");

    // Cria a imagem e define seu src
    const minhaImagem = document.createElement("img");
    minhaImagem.src = "caminho/para/imagem.jpg";

    // Cria o texto e define seu conteúdo
    const meuTexto = document.createElement("p");
    meuTexto.innerText = "Este é o meu texto.";

    // Cria o botão e define seu texto
    const meuBotao = document.createElement("button");
    meuBotao.innerText = "Clique aqui!";

    // Adiciona os elementos criados na div
    minhaDiv.appendChild(minhaImagem);
    minhaDiv.appendChild(meuTexto);
    minhaDiv.appendChild(meuBotao);

    // Insere a div dentro da div especificada
    div.appendChild(minhaDiv);
}

const minhaDiv = document.getElementById("minhaDiv");
inserirConteudoNaDiv(minhaDiv);
