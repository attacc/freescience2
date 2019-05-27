#!/usr/bin/perl
#########################################
# 187 Tutorials - HTTP://WWW.WRAPPER.TK #
# Simple Perl IRC BOT #
#########################################
# Settings - Edit This Stuff: #
#########################################
# --- Variables *Change These To Work For You* ---
$server = "www.webmaster.com";
$port = 7300;
$nick = "tuan-free";
$realname = "achap owns you";
$channel = "#singapore";
# --- Texts *Change These To Work For You* ---
# --- Hot Keys *Change These To Work For You* ---
$external = "JOIN $channel";
# --- Main Code *Edit Below At Own Risk!* ---
# --- Create Sockets ---
use IO::Socket;
$irc=IO::Socket::INET->new(
PeerAddr=>$server,
PeerPort=>$port,
Proto=>'tcp')or die "$server: $@\n";
print $irc "USER $nick $nick $nick :$realname\n";
print $irc "NICK $nick\n";
print "\n\nConnected to server...\n";
print $irc "JOIN $channel\n";
while(defined($in=<$irc>)){
      if($in=~/PING :(.*)/){
            print $irc "PONG $1\n";
      }
      if($in=~/KICK/){
            print $irc "JOIN $channel\n";
      }

      print "$in\n";
}
close($irc);