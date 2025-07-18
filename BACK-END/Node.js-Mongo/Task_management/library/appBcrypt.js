import appBcrypt from 'bcrypt';
const saltRounds = 10;

export const encryptPassword = async (password) => {
    try {
        const hashedPassword = await appBcrypt.hash(password, saltRounds);
        return hashedPassword;
    } catch (error) {
        console.error('Error encrypt:', error);
        throw error;
    }
};

export const comparePassword = async (password, hashedPassword) => {
    try {
        const match = await appBcrypt.compare(password, hashedPassword);
        return match;
    } catch (error) {
        console.error('Error compare the hash:', error);
        throw error;
    }
};