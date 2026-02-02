PERPLEXITY-AI-PROMPT-TEMPLATE.md

# Vytvoření správné adresářové struktury pro NuGet balíček / knihovnu

## Popis situace:

Můj návrh na adresářovou strukturu rootu repozitáře řešení SoundDelight

SoundDelight/ 
├── .github/workflows/ 	<!-- CI/CD scénáře (build, test, publish) 
├── artifacts/ 			<!-- Output z buildu 
├\── assets/ 				<!-- Obrázky a screenshoty, VOLITELNÉ, TEĎ URČITĚ NE, KAM S NÍ?
├\── benchmarks/ 	        <!-- Performance benchmarky, VOLITELNÉ, TEĎ URČITĚ NE
├── docs/ 				<!-- Dokumentace, Instrukce k vývoji 
├\── libs/ 				<!-- Lokálně referencované DLL knihovny, VOLITELNÉ, TEĎ URČITĚ NE 
├\── locale/ 				<!-- Lokalizace pro dokumenty v repozitáři / řešení, minimálně angličtina a čeština, KAM S NÍ?, VOLITELNÉ, TEĎ URČITĚ NE, CHTĚL BYCH JI
├\── packages/ 			<!-- Lokální NuGet balíčky, VOLITELNÉ, TEĎ URČITĚ NE 
├\── scripts/	 			<!-- Scaffolding skripty pro vytvoření řešení a adresářové struktury, může nazývat i tools, VOLITELNÉ, TEĎ URČITĚ NE
├── src/ 				<!-- Zdrojové kódy pro hlavní projekty řešení (V tomto případě knihovny) 
├── samples/ 			<!-- Ukázky použití, konzolová aplikace na real-time testování / experimentování 
├── tests/ 			         <!--Unit a jiné testy, JAKÉ VŠECHNY? 
├── SoundDelight.sln	        
├── Directory.Build.props    <!-- BUDU POTŘEBOVAT VYROBIT NA MÍRU !
├\── nuget.config	 	        <!-- VOLITELNÉ, TEĎ URČITĚ NE
├\── Build.cmd  			<!-- VOLITELNÉ, TEĎ URČITĚ NE
├\── Build.sh  			<!-- VOLITELNÉ, TEĎ URČITĚ NE
├── README.md
├── LICENCE(MIT)  
├── .editorconfig  		<!-- NA CO JE TENHLE SOUBOR DOBRÝ?
├── .gitignore  			<!-- BUDU POTŘEBOVAT VYROBIT NA MÍRU !
├── .gitattribute  			<!-- NA CO JE TENHLE SOUBOR DOBRÝ?
├── logo.ico  			<!-- PATŘÍ SEM?
├── logo.png  			<!-- PATŘÍ SEM?

## Problém / Otázka:
Splňuje to industry standard? Zkontroluj a ohodnoť můj návrh
Chci začít s minimálním počtem adresářů a ten případně zvětšovat.
adresář nebo soubor označený ├\── v implementaci nebude (aspoň zatim)
Chci, aby si odpověděl na otázky v komentáři za znakem <!--
Změnil by si něco v tom to návrhu? Vylepšil by si něco? Navrhni změny.
Jak by si tento problém řešil ty? Nechybí mi v návrhu nějaký soubor nebo adresář?

## Cíl / Čeho chci dosáhnout
Kvaliního stabilního profesionálního základu pro 
- vývoj knihovny / balíčku
- šablonu repozitáře knihovny / balíčku 

Adresářovou strukturu, která vznikne z finálního návrhu 
NECHCI MĚNIT, tím že budu mazat, přesouvat, přejmenovávat složky nebo soubory.
CHCI JI MĚNIT, ím že ji budu rozšiovat / zvětšovat počet adresářů ( Budu přidávat VOLITELNÉ )