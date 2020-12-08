<?php $rootPath = "../../" ?>
<?php require $rootPath . "build/head.php" ?>
    <script>setTitle("Hjem")</script>
<?php require $rootPath . "build/nav.php" ?>
<main id="kap8">
    <h2>1. Hva er et dataprogram?</h2>
    <p>En slags oppskrift som forteller datamaskinen hva den skal gjøre, steg for steg.</p>
    <h2>2. Forklar forskjellen mellom serversiden og klientsiden for programmer på nett.</h2>
    <p>Serversiden er den bakenomliggende delen av et program på nett, som kjøres på en webserver. Den tar seg av oppgaver som å kommunisere med databaser, andre eksterne maskiner eller andre tyngre oppgaver.
        Klientsiden er den lokale delen av et program på nett. Det kjøres direkte på brukerens maskin/nettleser og henter inn og sender data fra serversiden. Klientsiden er det som står for brukergrensesnittet og det vi fysisk ser.</p>
    <h2>3. Hva er forskjellen på en native app og en hybrid app?</h2>
    <p>En native app er en applikasjon som kjører på et spesifikt operativsystem. De er da ofte skrevet i operativsystemsspesifike programeringsspråk, feks. Swift til IOS/OS X.
        En hybrid app er en applikasjon som kan kjøre på flere operativsystemer. Dette gjøres ved at programmet ofte "pakkes inn" i en form for avspiller, som kommer med applikasjonen, der avspilleren gjerne er laget for det spesifike OS-et.</p>
    <h2>4. Hvorfor er det lurt å lage en skisse av programmet før vi begynner å skrive koden?</h2>
    <p>Man kan få en ordentlig oversikt over hva man trenger og hva man ikke trenger. Det blir lettere og mer effektivt å jobbe med et prosjekt om man planlegger først. Dessuten er det mye lettere å gjøre endringer i skisser eller lignende, dersom man ombestemmer seg om noe tidligere i arbeidsprossesen. Man får også ofte mye mer helhet i designet og funksjonaliteten.</p>
    <h2>6. Nevn de vanligste elementene vi finner i et programmeringsspråk (for eks. variabler, if-tester osv.), og forklar kort hvordan de fungerer.Engasjerende leser</h2>
    <p>-Variabler: Variabler er lagrede verdier i navngitte "beholdere".  Disse verdiene kan være av forskjellige datatyper, deriblant: Int (heltall), Float (kommatall), Number (alle former for tall), Char (ett skrifttegn), String (tekst), Boolean (sann eller usann).
        -Valgsetninger: Man kan bruke elementene "if" eller "else" (finnes også "elif/elseif") for å få koden til å gjennomføre noe utifra oppgitte betingelser. Disse fungerer slik at dersom noe innenfor "if"-en er oppfylt, kjører koden innfor. Om ikke, kjøres det som står innenfor "else"-en. (eller andre betingelser innenfor "elif/elseif"). For å danne disse betingelsene, kan man bruke matematiske operasjoner eller andre betingelser.
        -Løkker: Dette gjør det mulig å kjøre en del av koden flere ganger, så lenge betingelsen i løkka er oppfylt. Dette kan være at betingelsen er sann, eller at den skal kjøre et spesifikt antall ganger.
        -Array: En måte å oppevare mange verdier på. Her lagres de forskjellige verdiene i en liste, som også er indeksert, noe som gjør det lettere å behandle dataene.
        -Funksjoner: En navngitt samling kode, som man kan kjøre når man vil, bare man "henter den igjen" (kaller opp). Dette bidrar til å gjøre koden mer organisert, samt at man ikke trenger å skrive mye av den samme koden.</p>
    <h2>7. Forklar forskjellen på syntaktiske, semantiske og logiske feil.</h2>
    <p>-Syntaktiske: Kort fortalt skrivefeil. Dette kan være feil med bokstaver, mellomrom, tegnsetning eller feil bruke av paranteser eller innrykk.
        -Semantiske: Feil sammensetning av koden. Feks. en "else" uten "if", eller kjøre en funksjon med for mange parametere.
        -Logiske: Når det er en feil i logikken, som i matematikken, eller at noe kjører i evig tid.</p>
    <h2>8. Forklar forskjellen på kompilering og tolkning</h2>
    <p>Å kompilere koden er å konvertere koden til maskinkode. Da oversettes koden til objektkode, en type kode som maskinen lettere forstår. Ulempen med dette er eat selve kompileringen kan ta lang tid, samt gjøre feilsøking og testing vanskeligere.
        På den andre siden har vi tolkning, som på en annen side er at programmet man kjøres i en form for "avspiller", eller interpreter/tolk. Denne tolker koden og kjører det som maskinkode. Fordelen her er at man kan kjøre mye av den samme koden på flere operativsystemer, bare interpreteren er tilpasset OS-et. I motsetning, må kompilering ofte gjøres flere ganger og forskjellig til de forskjellige OS-ene man ønsker å bruke.</p>
    <h2>9. Hva betyr hendelsesorientert programmering?</h2>
    <p>At kode kjøres utifra spesifike hendelser, som feks. å trykke på en knapp. Dette gjøres ved å knytte en funksjon opp mot en hendelse.</p>
    <h2>10. 1) Hva er et versjonskontrollsystem? 2) List opp 3 ulike systemer for versjonskontroll.</h2>
    <p>1) Systemer/programmer som automatiserer håndteringen av ulike versjoner og endring i koden. Dette gjør det også mulig for flere utivklere å jobbe sammen på de samme filene, og setter sammen endringen til hver enkelt. Det gjør det også mulig/lettere å håndtere dokumentasjon og hvem som har gjort hvilke endringer. <br>
        2) Git, CVS, SVN.</p>
    <h2>11. Forklar hva som menes med følgende begreper innen objektorientert programmering:

        • abstraksjon
        • klasse
        • objekt
        • arv
        • konstruktor
        • polymorfisme
        • egenskap
        • metode
        • innkapsling
        • modularitetEngasjerende leser</h2>
    <p>-Abstraksjon: Når en klasse er lagd, trenger man ikke bry seg om koden som ligger i den. Man trenger bare å lage nye nye objekter ut av klassen og bruke metodene inni dem.
        -Klasse: Kort forklart en beskrivelse av et objekt.
        -Objekt: Når man programerer objektorientert, organiserer man programmet i mindre deler som er hva vi kaller objekter. Hvert objekt har en oppgave.
        -Arv: At en klasse kan basere seg på en annen klasse, slik at den "arver" dens egenskaper. Man kan også legge til nye datamedlemmer og metoder til den nye klassen.
        -Konstruktor:
        -Polymorfisme: At objekter kan behandles på samme måte, og samtidig gjøre ulike ting. Selv om en klasse arver metoder fra en annen, kan man da overstyre dem.
        -Egenskaper: Indikatorer som gjør en ting forskjellig fra andre.
        -Metode: Hva et objekt kan gjøre, altså hvilken handling som kan utføres.
        -Innkapsling: Når objekter ikke er mulige å endre direkte (private).
        -Modularitet: At man kan ha både variabler og funksjoner inni et objekt. Dette gjør koden mer oversiktlig.</p>
    <h2>12. Oppsummer kort hvilke fordeler du ser ved å benytte et objektorientert programmeringsspråk.</h2>
    <p>Fordeler ved OOP er at det er mer oversiktlig, modulært, det er gjennbrukbart og man kan skille mellom private og globale objekter. I tillegg har man konseptet med arv, hvor man også kan overstyre hierarkiet for å endre klasser som trenger andre metoder, men likevel mye av det andre.</p>
</main>