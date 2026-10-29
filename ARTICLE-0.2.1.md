# WPSketchupView 0.2.1: galeria 3D com runtime local e mais segurança

WPSketchupView é um plugin WordPress mantido por **LBETTERO** para publicar modelos SketchUp exportados no formato GLB. O visitante pode girar, ampliar e explorar o modelo diretamente no navegador, sem instalar programas adicionais.

O editor pode adicionar o bloco WPSketchupView no Gutenberg, informar a URL completa do arquivo GLB e publicar a página. O plugin também oferece um shortcode e uma galeria administrativa somente para leitura, que encontra arquivos GLB no diretório configurado dentro dos uploads do WordPress.

## O que muda na versão 0.2.1

A versão 0.2.1 protege e estabiliza os recursos introduzidos na série 0.2:

- remove a injeção direta de JavaScript por CDN durante a renderização do bloco;
- inclui localmente o pacote oficial `@google/model-viewer` 4.1.0;
- utiliza o sistema de enfileiramento do WordPress para carregar uma única cópia do runtime;
- inclui a licença Apache 2.0 do componente de terceiros;
- valida de forma centralizada as URLs usadas pelo bloco e pelo shortcode;
- aceita somente URLs absolutas com os protocolos HTTP ou HTTPS;
- move os estilos visuais do elemento para o arquivo CSS do plugin;
- adiciona testes de regressão para carregamento, renderização, URLs e saída como módulo JavaScript.

A galeria administrativa mantém a verificação de capacidade do WordPress, limita a descoberta ao subdiretório saneado dos uploads e escapa nomes e URLs antes da saída.

## Runtime local e modelos externos

O código necessário para exibir o modelo agora faz parte do próprio plugin. Isso elimina a dependência de um CDN JavaScript durante a visita e torna a versão executada mais fácil de identificar e atualizar.

O arquivo GLB ainda pode estar em uma origem externa, pois esse é um recurso do plugin. Nesse caso, o navegador do visitante precisa acessar o servidor indicado pelo editor. Sites com requisitos específicos de privacidade ou disponibilidade devem preferir modelos hospedados na própria instalação e definir uma política de origens compatível.

## Requisitos

- WordPress 6.0 ou superior;
- PHP 8.1 ou superior;
- Editor de blocos Gutenberg para o fluxo visual;
- navegador moderno com suporte a Web Components e WebGL;
- arquivo de modelo no formato GLB acessível por uma URL HTTP(S);
- configuração CORS adequada quando o modelo estiver hospedado em outro domínio.

## Disponibilidade

WPSketchupView é um projeto de código aberto mantido por **LBETTERO**.

- [Repositório do projeto](https://github.com/lbettero/wpsketchupview)
- [Release WPSketchupView 0.2.1](https://github.com/lbettero/wpsketchupview/releases/tag/0.2.1)
- [Política de segurança](https://github.com/lbettero/wpsketchupview/blob/main/SECURITY.md)
