// package pt.ulisboa.tecnico.meic.sirs;
// 
// import java.io.IOException;
// import java.io.FileInputStream;
// import java.io.FileOutputStream;
// 
// import javax.crypto.Cipher;
// import javax.crypto.CipherInputStream;
// import javax.crypto.CipherOutputStream;
// 
// import java.security.GeneralSecurityException;
// import java.security.Key;
// import java.security.KeyPair;
// import java.security.KeyPairGenerator;
// import java.security.PrivateKey;
// import java.security.PublicKey;
// 
// import javax.imageio.ImageIO;
// 
// /**
// * Encrypts an image with the RSA algorithm with a given RSA public key
// */
// public class ImageRSACipher {
// 	
// 	public static void main(String[] args) throws IOException {
// 		
// 		if(args.length != 3) {
// 			System.err.println("This program encrypts an image file with RSA.");
// 			System.err.println("Usage: ImageRSACipher [inputFile.png] [AESKeyFile] [outputFile.png]");
// 			return;
// 		}
// 		
// 		final String inputFile = args[0];
// 		final String keyFile = args[1];
// 		final String outputFile = args[2];
// 		
// 		
// 		Cipher cipher = Cipher.getInstance("RSA");
// 		
// 		Key pubKey = RSAKeyGenerator.read(keyFile);
// // 		FIXME: check if is public key
// 
// 		cipher.init(Cipher.ENCRYPT_MODE, pubKey);
// 
// 		FileOutputStream fos = new FileOutputStream(outputFile);
// 		FileInputStream fis = new FileInputStream(inputFile);
// 		CipherInputStream cis = new CipherInputStream(fis, cipher);
// 		
// // 		int t = 0;
// // 		while ((t = cis.read(cis)) > 0) {  
// // 			fos.write(buffer, 0, r);  
// // 		} 
// 		
// 		fos.write(cipher);
// 		
// 		System.out.println("DONE.");
// 		fos.close();
// 		cis.close();
// 		fis.close();
// 		
// 		
// 		
// // 		AESCipherByteArrayMixer cipher = new AESCipherByteArrayMixer(Cipher.ENCRYPT_MODE);
// // 		cipher.setParameters(keyFile, mode);
// // 		ImageMixer.mix(inputFile, outputFile, cipher);
// 		
// 	}
// 	
// 	
// // 	private static byte[] imageToByteArray(String path) {
// //         BufferedImage image = ImageIO.read(new File(path));
// //         DataBuffer imageDataBuffer = image.getRaster().getDataBuffer();
// //         return ((DataBufferByte)imageDataBuffer).getData();
// //     }
// 
// 
// }
// 
// 
